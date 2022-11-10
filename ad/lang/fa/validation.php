<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/
	
	'accepted'              => ':attribute باید پذیرفته شود.',
	'accepted_if'           => 'زمانی که :other :value باشد باید :attribute پذیرفته شود.',
	'active_url'            => ':attribute یک URL معتبر نیست.',
	'after'                 => ':attribute باید تاریخی بعد از :date باشد.',
	'after_or_equal'        => ':attribute باید تاریخ بعد یا برابر با :date باشد.',
	'alpha'                 => ':attribute ممکن است فقط شامل حروف باشد.',
	'alpha_dash'            => ':attribute ممکن است فقط شامل حروف، اعداد، خط تیره و زیرخط باشد.',
	'alpha_num'             => ':attribute ممکن است فقط شامل حروف و اعداد باشد.',
	'array'                 => ':attribute باید یک آرایه باشد.',
	'before'                => ':attribute باید تاریخی قبل از :date باشد.',
	'before_or_equal'       => ':attribute باید تاریخی قبل یا برابر با :date باشد.',
	'between'               => [
		'array'   => ':attribute باید بین موارد :min و :max داشته باشد.',
		'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
		'numeric' => ':attribute باید بین :min و:max باشد.',
		'string'  => ':attribute باید بین کاراکترهای :min و :max باشد.',
	],
	'boolean'               => 'فیلد :attribute باید درست یا نادرست باشد.',
	'confirmed'             => 'تأیید :attribute مطابقت ندارد.',
	'current_password'      => 'رمز عبور نادرست است.',
	'date'                  => ':attribute تاریخ معتبری نیست.',
	'date_equals'           => ':attribute باید تاریخی برابر با :date باشد.',
	'date_format'           => ':attribute با قالب :format مطابقت ندارد.',
	'declined'              => ':attribute باید رد شود.',
	'declined_if'           => 'زمانی که :other :value باشد باید :attribute را رد کرد.',
	'different'             => ':attribute و :other باید متفاوت باشند.',
	'digits'                => ':attribute باید ارقام :digits باشد.',
	'digits_between'        => ':attribute باید بین رقم :min و :max باشد.',
	'dimensions'            => ':attribute دارای ابعاد تصویر نامعتبر است.',
	'distinct'              => 'فیلد :attribute دارای یک مقدار تکراری است.',
	'email'                 => ':attribute باید یک آدرس ایمیل معتبر باشد.',
	'ends_with'             => 'صفت : باید به یکی از موارد زیر ختم شود: :values.',
	'enum'                  => ':attributeانتخاب شده نامعتبر است.',
	'exists'                => ':attribute انتخاب شده نامعتبر است.',
	'file'                  => ':attribute باید یک فایل باشد.',
	'filled'                => 'فیلد :attribute باید دارای مقدار باشد.',
	'gt' => [
		'array'   => ':attribute باید بیش از موارد :value داشته باشد.',
		'file'    => ':attribute باید بیشتر از کیلوبایت :value باشد.',
		'numeric' => ':attribute باید بزرگتر از :value باشد.',
		'string'  => ':attribute باید بزرگتر از کاراکترهای :value باشد.',
	],
	'gte' => [
		'array'   => ':attribute باید دارای آیتم های :value یا بیشتر باشد.',
		'file'    => ':attribute باید بزرگتر یا مساوی با :value کیلوبایت باشد.',
		'numeric' => ':attribute باید بزرگتر یا مساوی با :value باشد.',
		'string'  => ':attribute باید بزرگتر یا مساوی با نویسه های :value باشد.',
	],
	'image'                 => ':attribute باید یک تصویر باشد.',
	'in'                    => ':attribute انتخاب شده نامعتبر است.',
	'in_array'              => 'فیلد :attribute در :other وجود ندارد.',
	'integer'               => ':attribute باید یک عدد صحیح باشد.',
	'ip'                    => ':attribute باید یک آدرس IP معتبر باشد.',
	'ipv4'                  => ':attribute باید یک آدرس IPv4 معتبر باشد.',
	'ipv6'                  => ':attribute باید یک آدرس IPv6 معتبر باشد.',
	'json'                  => ':attribute باید یک رشته JSON معتبر باشد.',
	'lt' => [
		'array'   => ':attribute باید کمتر از موارد :value داشته باشد.',
		'file'    => ':attribute باید کمتر از :value کیلوبایت باشد.',
		'numeric' => ':attribute باید کمتر از :value باشد.',
		'string'  => ':attribute باید کمتر از کاراکترهای :value باشد.',
	],
	'lte' => [
		'array'   => ':attribute نباید بیش از موارد :value داشته باشد.',
		'file'    => ':attribute باید کمتر یا مساوی :value کیلوبایت باشد.',
		'numeric' => ':attribute باید کمتر یا مساوی با :value باشد.',
		'string'  => ':attribute باید کمتر یا مساوی با نویسه های :value باشد.',
	],
	'mac_address'           => ':attribute باید یک آدرس MAC معتبر باشد.',
	'max'                   => [
		'array'   => ':attribute نباید بیش از موارد :max داشته باشد.',
		'file'    => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
		'numeric' => ':attribute نباید بیشتر از :max باشد.',
		'string'  => ':attribute نباید از نویسه های :max بیشتر باشد.',
	],
	'mimes'                 => ':attribute باید فایلی از نوع: :values باشد.',
	'mimetypes'             => ':attribute باید فایلی از نوع: :values باشد.',
	'min'                   => [
		'numeric' => ':attribute باید حداقل :min باشد.',
		'file'    => ':attribute باید حداقل :min کیلوبایت باشد.',
		'string'  => ':attribute باید حداقل کاراکتر :min باشد.',
		'array'   => ':attribute باید حداقل موارد :min داشته باشد.',
	],
	'multiple_of'           => ':attribute باید مضرب :value باشد.',
	'not_in'                => ':attributeانتخاب شده نامعتبر است.',
	'not_regex'             => 'قالب :attribute نامعتبر است.',
	'numeric'               => ':attribute باید یک عدد باشد.',
	'password' => [
		'letters'       => ':attribute باید حداقل یک حرف داشته باشد.',
		'mixed'         => ':attribute باید حداقل یک حرف بزرگ و یک حرف کوچک داشته باشد.',
		'numbers'       => ':attribute باید حداقل یک عدد داشته باشد.',
		'symbols'       => ':attribute باید حداقل یک نماد داشته باشد.',
		'uncompromised' => ':attribute داده شده در نشت داده ظاهر شده است. لطفاً یک :attribute متفاوت انتخاب کنید.',
	],
	'present'               => 'فیلد :attribute باید وجود داشته باشد.',
	'prohibited'            => 'فیلد :attribute ممنوع است.',
	'prohibited_if'         => 'وقتی :other :value باشد، فیلد :attribute ممنوع است.',
	'prohibited_unless'     => 'فیلد :attribute ممنوع است مگر اینکه :other در :values باشد.',
	'prohibits'             => 'فیلد :attribute حضور :other را ممنوع می کند.',
	'regex'                 => 'قالب :attribute نامعتبر است.',
	'required'              => 'فیلد :attribute الزامی است.',
	'required_array_keys'   => 'فیلد :attribute باید حاوی ورودی هایی برای: :values باشد.',
	'required_if'           => 'وقتی :other :value باشد فیلد :attribute لازم است.',
	'required_unless'       => 'فیلد :attribute الزامی است مگر اینکه :other در :values باشد.',
	'required_with'         => 'وقتی :values وجود دارد، فیلد :attribute الزامی است.',
	'required_with_all'     => 'وقتی :values وجود دارد، فیلد :attribute الزامی است.',
	'required_without'      => 'فیلد :attribute زمانی لازم است که :values وجود نداشته باشد.',
	'required_without_all'  => 'فیلد :attribute زمانی لازم است که هیچ یک از :value ها وجود نداشته باشد.',
	'same'                  => ':attributeو :دیگر باید مطابقت داشته باشند.',
	'size'                  => [
		'array'   => ':attribute باید شامل موارد :size باشد.',
		'file'    => ':attribute باید :size کیلوبایت باشد.',
		'numeric' => ':attribute باید :size باشد.',
		'string'  => ':attribute باید کاراکترهای :size باشد.',
	],
	'starts_with'           => ':attribute باید با یکی از موارد زیر شروع شود: :values',
	'string'                => ':attribute باید یک رشته باشد.',
	'timezone'              => ':attribute باید یک ناحیه معتبر باشد.',
	'unique'                => ':attribute قبلاً گرفته شده است.',
	'uploaded'              => ':attribute بارگذاری نشد.',
	'url'                   => 'قالب :attribute نامعتبر است.',
	'uuid'                  => ':attribute باید یک UUID معتبر باشد.',
	
	
	// Packages Rules
	'captcha'      => 'فیلد :attribute صحیح نیست.',
	'recaptcha'    => 'فیلد :attribute صحیح نیست.',
	'phone'        => 'فیلد :attribute حاوی یک عدد نامعتبر است.',
	'phone_number' => 'شماره تلفن شما معتبر نیست.',
	
	
	// Custom Rules
	'required_package_id'                     => 'برای ادامه باید یک گزینه آگهی برتر را انتخاب کنید.',
	'required_payment_method_id'              => 'برای ادامه باید یک روش پرداخت را انتخاب کنید.',
	'blacklist_unique'                        => 'مقدار فیلد :attribute قبلاً برای :type ممنوع شده است.',
	'blacklist_email_rule'                    => 'این آدرس ایمیل در لیست سیاه قرار دارد.',
	'blacklist_phone_rule'                    => 'این شماره تلفن در لیست سیاه قرار دارد.',
	'blacklist_domain_rule'                   => 'دامنه آدرس ایمیل شما در لیست سیاه قرار دارد.',
	'blacklist_ip_rule'                       => ':attribute باید یک آدرس IP معتبر باشد.',
	'blacklist_word_rule'                     => ':attribute حاوی کلمات یا عبارات ممنوعه است.',
	'blacklist_title_rule'                    => ':attribute حاوی کلمات یا عبارات ممنوعه است.',
	'between_rule'                            => ':attribute باید بین کاراکترهای :min و :max باشد.',
	'username_is_valid_rule'                  => 'فیلد :attribute باید یک رشته الفبایی باشد.',
	'username_is_allowed_rule'                => ':attribute مجاز نیست.',
	'locale_of_language_rule'                 => 'فیلد :attribute معتبر نیست.',
	'locale_of_country_rule'                  => 'فیلد :attribute معتبر نیست.',
	'currencies_codes_are_valid_rule'         => 'فیلد :attribute معتبر نیست.',
	'custom_field_unique_rule'                => ':field_1 این :field_2 را قبلاً اختصاص داده است.',
	'custom_field_unique_rule_field'          => ':field_1 قبلاً به این :field_2 اختصاص داده شده است.',
	'custom_field_unique_children_rule'       => 'یک فرزند :field_1 از :field_1 این :field_2 را قبلاً اختصاص داده است.',
	'custom_field_unique_children_rule_field' => ':field_1 قبلاً به یکی از :field_2 از این :field_2 اختصاص داده شده است.',
	'custom_field_unique_parent_rule'         => 'والد :field_1 از :field_1 این :field_2 را قبلاً اختصاص داده است.',
	'custom_field_unique_parent_rule_field'   => ':field_1 قبلاً به والد :field_2 این :field_2 اختصاص داده شده است.',
	'mb_alphanumeric_rule'                    => 'لطفاً یک محتوای معتبر را در قسمت :attribute وارد کنید.',
	'date_is_valid_rule'                      => 'فیلد :attribute دارای تاریخ معتبری نیست.',
	'date_future_is_valid_rule'               => 'تاریخ فیلد :attribute باید در آینده باشد.',
	'date_past_is_valid_rule'                 => 'تاریخ فیلد :attribute باید در گذشته باشد.',
	'video_link_is_valid_rule'                => 'فیلد :attribute حاوی پیوند ویدیویی معتبر (Youtube یا Vimeo) نیست.',
	'sluggable_rule'                          => 'فیلد :attribute فقط شامل کاراکترهای نامعتبر است.',
	'uniqueness_of_listing_rule'                 => 'شما قبلاً این آگهی را پست کرده اید. نمی توان آن را تکرار کرد.',
	'uniqueness_of_unverified_listing_rule'      => 'شما قبلاً این آگهی را پست کرده اید. لطفاً آدرس ایمیل یا پیامک خود را بررسی کنید تا دستورالعمل‌های اعتبارسنجی را دنبال کنید.',
	
	
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/
	
	'custom' => [
		
		'database_connection'      => [
			'required' => 'نمی توان به سرور MySQL متصل شد',
		],
		'database_not_empty'       => [
			'required' => 'پایگاه داده خالی نیست لطفاً پایگاه داده را خالی کنید یا <a href="./database">پایگاه داده دیگری</a> را مشخص کنید.',
		],
		'promo_code_not_valid'     => [
			'required' => 'کد تبلیغاتی معتبر نیست',
		],
		'smtp_valid'               => [
			'required' => 'نمی توان به سرور SMTP متصل شد',
		],
		'yaml_parse_error'         => [
			'required' => 'نمی توان yaml را تجزیه کرد. لطفا نحو را بررسی کنید',
		],
		'file_not_found'           => [
			'required' => 'فایل پیدا نشد.',
		],
		'not_zip_archive'          => [
			'required' => 'فایل یک بسته فشرده نیست.',
		],
		'zip_archive_unvalid'      => [
			'required' => 'نمی توان بسته را خواند.',
		],
		'custom_criteria_empty'    => [
			'required' => 'معیارهای سفارشی نمی توانند خالی باشند',
		],
		'php_bin_path_invalid'     => [
			'required' => 'قابل اجرا PHP نامعتبر است. لطفا دوباره بررسی کنید.',
		],
		'can_not_empty_database'   => [
			'required' => 'نمی توان جداول خاصی را رها کرد. لطفاً پایگاه داده خود را به صورت دستی پاک کنید و دوباره امتحان کنید.',
		],
		'can_not_create_database_tables'   => [
			'required' => 'نمی توان جداول خاصی ایجاد کرد. لطفاً مطمئن شوید که از امتیازات کامل در پایگاه داده دارید و دوباره امتحان کنید.',
		],
		'can_not_import_database_data'   => [
			'required' => 'نمی‌توان همه داده‌های مورد نیاز برنامه را وارد کرد. لطفا دوباره تلاش کنید.',
		],
		'recaptcha_invalid'        => [
			'required' => 'بررسی reCAPTCHA نامعتبر است.',
		],
		'payment_method_not_valid' => [
			'required' => 'مشکلی در تنظیم روش پرداخت رخ داد. لطفا دوباره بررسی کنید.',
		],
	
	],
	
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/
	
	'attributes' => [
		
		'gender'                => 'جنسیت',
		'gender_id'             => 'جنسیت',
		'name'                  => 'نام',
		'first_name'            => 'نام کوچک',
		'last_name'             => 'نام خانوادگی',
		'user_type'             => 'نوع کاربر',
		'user_type_id'          => 'نوع کاربر',
		'country'               => 'کشور',
		'country_code'          => 'کشور',
		'phone'                 => 'تلفن',
		'address'               => 'نشانی',
		'mobile'                => 'موبایل',
		'sex'                   => 'جنسیت',
		'year'                  => 'سال',
		'month'                 => 'ماه',
		'day'                   => 'روز',
		'hour'                  => 'ساعت',
		'minute'                => 'دقیقه',
		'second'                => 'ثانیه',
		'username'              => 'نام کاربری',
		'email'                 => 'آدرس ایمیل',
		'password'              => 'کلمه عبور',
		'password_confirmation' => 'تایید رمز عبور',
		'g-recaptcha-response'  => 'کپچا',
		'accept_terms'          => 'مقررات',
		'category'              => 'دسته بندی',
		'category_id'           => 'دسته بندی',
		'post_type'             => 'نوع پست',
		'post_type_id'          => 'نوع پست',
		'title'                 => 'عنوان',
		'body'                  => 'body',
		'description'           => 'شرح',
		'excerpt'               => 'چکیده',
		'date'                  => 'تاریخ',
		'time'                  => 'زمان',
		'available'             => 'در دسترس',
		'size'                  => 'اندازه',
		'price'                 => 'قیمت',
		'salary'                => 'حقوق',
		'contact_name'          => 'نام',
		'location'              => 'محل',
		'admin_code'            => 'محل',
		'city'                  => 'شهر',
		'city_id'               => 'شهر',
		'package'               => 'بسته بندی',
		'package_id'            => 'بسته بندی',
		'payment_method'        => 'روش پرداخت',
		'payment_method_id'     => 'روش پرداخت',
		'sender_name'           => 'نام',
		'subject'               => 'موضوع',
		'message'               => 'پیام',
		'report_type'           => 'نوع گزارش',
		'report_type_id'        => 'نوع گزارش',
		'file'                  => 'فایل',
		'filename'              => 'نام فایل',
		'picture'               => 'تصویر',
		'resume'                => 'از سرگیری',
		'login'                 => 'وارد شدن',
		'code'                  => 'کد',
		'token'                 => 'نشانه',
		'comment'               => 'کامنت',
		'rating'                => 'رتبه بندی',
		'locale'                => 'محل',
		'currencies'            => 'ارزها',
		'tags'					=> 'برچسب ها',
		'from_name'             => 'نام',
		'from_email'            => 'پست الکترونیک',
		'from_phone'            => 'تلفن',
		'captcha'               => 'کد امنیتی',
		
	],

];
