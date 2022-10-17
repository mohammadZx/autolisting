<style>
.force-login-body {
margin: 30px 0;
}
   .force-login-body .wrapper {
    display: flex;
    justify-content: center;
    text-align: right;
        }
.force-login-body .code {
    margin-top: 10px;
}
        .force-login-body h3, .force-login-body > p {
            text-align: center;
            margin: 10px auto;
          width: fit-content;
        }
  .force-login-body > p{
  margin-bottom: 30px;
  }
        .force-login-body .submit {
    margin-top: 10px;
        }
        .force-login-body label {
            min-width: 123px;
            display: block;
        }

.force-login-body .code, .force-login-body #submit{
    display: none;
}

.force-login-body form#register .name {
    display: none;
}

.force-login-body .code.active, .force-login-body #submit.active{
    display: block;
}
.force-login-body .dark.send{
    opacity: .5;
    pointer-events: none;
}
.force-login-body .unactive{
    pointer-events: none;
    opacity: .5;
}
  
  .force-login-body span.valid-feedback {
    font-size: 11px;
    color: gree\;
}

.force-login-body span.valid-feedback strong {color: green !important;}

.force-login-body span.valid-feedback {
    margin-top: 11px !important;
    display: block;
}

.force-login-body form#register input {
    border: 1px solid #d1d1d1;
    margin-top: 5px;
}

.force-login-body form#register button {
    border: none;
    color: #fff;
    background: #0892de;
    padding: 5px;
    border-radius: 5px;
}

.force-login-body form#register {
    width: 300px;
    max-width: 100%;
}

.force-login-body form#register input {
    width: 100%;
}
  .force-login-body form#register .name.active{
  display: block;
  }
.force-login-body h3 {
    border-bottom: 2px solid #fc3;
    padding-bottom: 10px;
}

.force-login-body .submit #submit {
    width: 100%;
    margin-top: 10px;
}

.force-login-body button.dark {
    width: 100%;
}
  .force-login-body .invalid-feedback{
  display: block !important;
  }

.force-login-body .valid .feedback {color: green;}

.force-login-body .valid input {border-color: green !important;}


.force-login-body .invalid .feedback {color: red;}

.force-login-body .invalid input {border-color: red !important;}
.ecc a:not(.button-my) { color: #ff004c !important; }

</style>

<div class="force-login-body">  
  			<h3>ورود یا ثبت نام</h3>
            <div class="wrapper">
              	
                <form id="register" class="my_captcha_form" data-redirect="{{url('/account/posts/list')}}" tabindex="502" action="{{ route('login-code') }}" method="POST">
                    @csrf
                <div class="phone">
                        <label>تلفن</label>
                        <input id="phone" type="tel" class="form-control" name="phone" placeholder="09120000000" required >
                        <span class="feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                  
                  
                  <div class="name" id="namefield">
                        <label>نام و نام خانوادگی</label>
                        <input id="name" type="text" class="form-control" name="name" value="" >
                        <span class="feedback"  role="alert">
                            <strong></strong>
                        </span>
                    </div>
                  
                    <div class="code">
                        <label>کد تایید</label>
                        <input id="code" type="number" onkeyup="setState(this)" class="form-control" name="code" required >
                        <span class="feedback"  role="alert">
                            <strong></strong>
                        </span>
                    </div>

                    <div class="submit">
                        <button type="button"class="dark" id="sendCode">ارسال کد تایید</button>
                        <button id="submit" class="unactive">ورود</button>
                    </div>
                </form>
              
              
            </div>
    </div>

 <script>
        timer = 60
        var timerInterval
		const _ = elm => document.querySelector(elm)
		const __ = elm => document.querySelectorAll(elm)

		const authAlert = (query , data) => {
			_(query).classList.add(data.status)
			_(query + ' .feedback strong').innerHTML = data.message
			return;
		}
		
		const clearAlert = query => {
			_(query).classList.contains('valid') ?  _(query).classList.remove('valid') : null
			_(query).classList.contains('invalid') ? _(query).classList.remove('invalid')  : null

			_(query + ' .feedback strong').innerHTML = ""
			return
		}
   
		_('#sendCode').addEventListener('click', sendCode)
        function sendCode(){
			x = this
            phone = _('#phone').value
			clearAlert('#register .phone')
			
            if(phone.length != 11 || (phone.substr(0,2) != "09" && phone.substr(0,2) != "۰۹")){
				authAlert('#register .phone', {
					status: 'invalid',
					message: 'لطفا شماره تلفن خود را به درستی وارد کنید'
				});

                return;
            }
     
	 	

            // fix dependencies
			_('#register .code').classList.add('active')
			_('#register #submit').classList.add('active')
            
            
            // send code
		
			fetch(`/ad/send-code/${phone}`).then(res => res.json()).then(res => {
				for(item of res.messages){
					authAlert('#register .'+ item.input, {
							status: item.status,
							message: item.message
					});
				}

				if(!res.user_register_status){
					_('#namefield').classList.add('active')
				}else{
					_('#namefield').classList.contains('active') ? _('#namefield').classList.remove('active') : null
				}

				if(res.status && res.status == 200){
				x.classList.add('send');
				runTimer(x);
				}

			})
          

        }

        function runTimer(x){
            timerInterval = setInterval(() => {
                timer--
                x.innerHTML = "ارسال مجدد بعد از " + timer + " ثانیه "
                if(timer == 0){
                    clearInterval(timerInterval)
                    x.innerHTML = "ارسال کد تایید"
                    x.classList.remove('send');
                    timer = 60;
                }
            }, 1000);
        }

        function setState(val){
            submitButton = document.getElementById('submit');
            codeAlert = document.getElementById('code-alert');
            if(val.value.length != 4){
                submitButton.classList.add('unactive')
            }else{
                submitButton.classList.remove('unactive')
            }
        
        }

		

		_('#register').addEventListener('submit', submitAuthForm);
		function submitAuthForm(e){
			e.preventDefault();
			if(!validatingAuthForm()) return;


			const form = new FormData();
			form.append('phone', _('#phone').value);
			form.append('name', _('#name').value);
			form.append('code', _('#code').value);
			form.append('_token', _('input[name=_token]').value);
			form.append('action', 'auth_send');
			const params = new URLSearchParams(form);

			fetch('/ad/code-login', {
				method: 'POST',
				body: form
			}).then(res => res.json()).then(res => {
				
				if(res.status && res.status == 200){

					if(_('#register').getAttribute('data-redirect') != "false"){
						window.location = res.redirect_to || _('#register').getAttribute('data-redirect')
					}

                    if(_('#register').getAttribute('data-close')){
                            setTimeout(function(){
                                _('.mfp-close').click()
                            }, 1000)
                    }

                    if(_('#register').getAttribute('data-callback')){
                        window[_('#register').getAttribute('data-callback')]()
                    }

                    for(var n of __('.guest-none')){
                        n.classList.remove('guest-none')
                    }
                    for(var n of __('.guest-show')){
                        n.classList.remove('guest-show')
                    }

					_('#name').classList.add('unactive');
					_('#code').classList.add('unactive');
					_('#phone').classList.add('unactive');
					_('#submit').classList.add('dnone');
					_('#sendCode').classList.add('dnone');

					if(_('#billing_first_name')){
						_('#billing_first_name').value = res.user.name;
					}

					if(_('#billing_phone')){
						_('#billing_phone').value = res.user.phone;
					}

					for(item of res.messages){
						authAlert('#register .'+ item.input, {
								status: item.status,
								message: item.message
						});
					}
					
				}else{
					for(item of res.messages){
						authAlert('#register .'+ item.input, {
								status: item.status,
								message: item.message
						});
					}
				}
				
			})
			
			


		

		}


	const validatingAuthForm = () => {

			phone = _('#phone').value
			clearAlert('#register .phone')
			
            if(phone.length != 11 || (phone.substr(0,2) != "09" && phone.substr(0,2) != "۰۹")){
				authAlert('#register .phone', {
					status: 'invalid',
					message: 'لطفا شماره تلفن خود را به درستی وارد کنید'
				});

                return false;
            }

			clearAlert('#register .code')
			if(_('#code').value.length != 4){
				authAlert('#register .code', {
					status: 'invalid',
					message: 'لطفا کد تایید 4 رقمی را وارد کنید'
				});

                return false;
			}


			clearAlert('#register .name')
			if(_('#namefield').classList.contains('active') && _('#name').value.length < 2){
				authAlert('#register .name', {
					status: 'invalid',
					message: 'لطفا نام خود را وارد کنید'
				});

                return false;
			}

			return true;
		}
		
    </script>
