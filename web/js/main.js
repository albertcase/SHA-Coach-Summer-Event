;(function(){



	function getClass(el){
		return document.querySelector('.' + el);
	}


	function shopReset(val){
		if(!val){
			getClass('select-date').setAttribute('disabled', 'disabled');
		}

		getClass('select-num').setAttribute('disabled', 'disabled');
		getClass('select-date').value = '';
		getClass('select-num').value = '';
		getClass('date').value = '';
		getClass('num').value = '';	
	}

	function dateReset(){
		getClass('select-num').setAttribute('disabled', 'disabled');
		getClass('select-num').value = '';
		getClass('num').value = '';	
	}


	/*
	 * select 重写
	 */
	var selectEl = document.querySelectorAll('.select-el');
	for(var i = 0; i < selectEl.length; i++){
		selectEl[i].addEventListener('change', function(){
			var attr = this.getAttribute("data-type");

			var index = this.selectedIndex;
		    var selectValue = this.options[index].value;
		    var selectText = this.options[index].text;

			if(attr == 'num'){
				getClass(attr).value = selectText;
				getClass(attr).setAttribute('data-id', selectValue);
			}else if(attr == 'date'){
				getClass(attr).value = selectText;
			}else{
				getClass(attr).value = selectValue;
			}
			

			if(attr == 'shop' && !selectValue){
				shopReset(selectValue);
			}

			// console.log(attr, selectValue);
			if(attr == 'shop' && selectValue){
				getClass('select-date').removeAttribute('disabled');
				queryQuotaData.getDate(selectValue);
				shopReset(selectValue);
			}

			if(attr == 'date' && !selectValue){
				dateReset();
			}

			if(attr == 'date' && selectValue){
				getClass('select-num').removeAttribute('disabled');
				getClass('select-num').innerHTML = '';
				getClass('num').value = '';
				queryQuotaData.getNum(getClass('shop').value, selectValue);
			}


		})
	}

	/*
	 * form
	 */

	function check(){
		var shop = getClass('shop').value,
			date = getClass('date').value,
			num = getClass('num').value;
		var numId = getClass('num').getAttribute('data-id');

		if(!shop || shop == ''){
			formErrorTips('请选择店铺！');
		}else if(!date || date == ''){
			formErrorTips('请选择日期！');
		}else if(!num || num == ''){
			formErrorTips('请选择场次！');
		}else{
			if(orderBtn.className.indexOf('isloading') < 0){
				orderBtn.className += ' isloading';
			}
			
			submitForm({ id: numId });
		}
	}

	var orderBtn = document.querySelector('.order_btn');
	orderBtn.addEventListener('click', function(){
		if(orderBtn.className.indexOf('isloading') < 0){
			check();
		}
	})



	/* 
	 * 获取api数据
	 */
	function QueryQuotaData(){
		this.allData = null;
		this.init = function(){
			var self = this;
			ajax('GET', '/api/quota', {}, function(result){
				// console.log(result);
				self.allData = result;
				self.getShop();
			})
		}

		this.getShop = function(){
			var data = this.allData;
			var shopData = ['<option></option>'];
			for(var shop in data){
	        	shopData.push('<option>'+ shop +'</option>');
	        }
	        this.writeShop(shopData);
		}

		this.writeShop = function(data){
			getClass('select-shop').innerHTML = data.join('');
		}

		this.init()
	}

	QueryQuotaData.prototype.getDate = function(val){
		var data = this.allData[val],
			dateData = ['<option></option>'];

		for(var date in data){
			dateData.push('<option value="'+ date +'">'+ date +'</option>');
		}
		
		getClass('select-date').innerHTML = dateData.join('');
	}

	QueryQuotaData.prototype.getNum = function(shopVal, dateVal){
		var data = this.allData[shopVal][dateVal],
			numData = ['<option></option>'];

		for(var i = 0; i < data.length; i++){
			numData.push('<option value="'+ data[i].id +'" '+ (data[i].has_quota ? '' : 'disabled') +' >'+ data[i].time +'</option>');
		}

		getClass('select-num').innerHTML = numData.join('');
	}

	var queryQuotaData = new QueryQuotaData();



	function submitForm(data){
	    ajax('POST', '/api/submit', data, function(result){
	        if(result.status == 200){
	            formErrorTips('数据提交成功！');
	            // location.href = '/qrcode';
	            submitSuccess(result.data.date, result.data.shop);
	        }
	        orderBtn.className = orderBtn.className.replace(' isloading', '');
	    });
	}



	// 提交成功
	function submitSuccess(date, shop){
		var result = document.getElementById('result'),
			form = document.getElementById('form'),
			cb = getClass('result-footer');

		cb.innerHTML = date + '<br>' + shop + '期待您的莅临！';

		form.style.display = 'none';
		result.style.display = 'inline-block';
	}



}());