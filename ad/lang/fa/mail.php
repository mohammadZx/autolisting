<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Emails Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are used by the Mail notifications.
	|
	*/
	
	// built-in template
	'Whoops!' => 'اوف!',
	'Hello!' => 'سلام!',
	'Regards' => 'با احترام',
	"having_trouble_on_link" => "اگر با کلیک کردن روی دکمه \":actionText\" مشکل دارید، URL زیر را کپی کنید و\nدر مرورگر وب خود جایگذاری کنید:",
	'All rights reserved.' => 'تمامی حقوق محفوظ است.',
	
	
	// mail salutation
	'footer_salutation' => 'با احترام،<br>:appName',
	
	
	// custom mail_footer (unused)
	'mail_footer_content'            => 'فروش و خرید در نزدیکی شما. ساده، سریع و کارآمد.',
	
	
	// example
	'email_example_title'       => ':appName Mail با موفقیت راه اندازی شد',
	'email_example_content_1'   => 'تنظیم ایمیل با موفقیت انجام شد!',
	'email_example_content_2'   => 'این ایمیل برای آزمایش اعتبار نامه جدید شما برای :appName ارسال شده است. از آنجایی که شما این ایمیل را دریافت کرده اید، ایمیل به درستی تنظیم شده است و می توان این ایمیل را نادیده گرفت.',
	
	
	// email_verification
	'email_verification_title'       => 'لطفا آدرس ایمیل خود را تایید کنید.',
	'email_verification_action'      => 'تایید آدرس پست الکترونیکی',
	'email_verification_content_1'   => 'سلام :username!',
	'email_verification_content_2'   => 'برای تایید آدرس ایمیل خود روی دکمه زیر کلیک کنید.',
	'email_verification_content_3'   => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً یک حساب جدید :appName ایجاد کرده‌اید یا یک آدرس ایمیل جدید اضافه کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',
	
	
	// post_activated (new)
	'post_activated_title'             => 'لیست شما فعال شده است',
	'post_activated_content_1'         => 'سلام,',
	'post_activated_content_2'         => 'فهرست <a href=":postUrl">:title</a> شما فعال شده است.',
	'post_activated_content_3'         => 'به زودی توسط یکی از مدیران ما برای انتشار آنلاین بررسی خواهد شد.',
	'post_activated_content_4'         => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً فهرست جدیدی در :appName ایجاد کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',
	
	
	// post_reviewed (new)
	'post_reviewed_title'              => 'فهرست شما اکنون آنلاین است',
	'post_reviewed_content_1'          => 'سلام,',
	'post_reviewed_content_2'          => 'فهرست <a href=":postUrl">:title</a> شما اکنون آنلاین است.',
	'post_reviewed_content_3'          => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً فهرست جدیدی در :appName ایجاد کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',
	
	
	// post_republished (new)
	'post_republished_title'              => 'فهرست شما مجدداً منتشر شده است',
	'post_republished_content_1'          => 'سلام,',
	'post_republished_content_2'          => 'فهرست شما <a href=":postUrl">:title</a> با موفقیت مجدداً منتشر شد.',
	'post_republished_content_3'          => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً فهرست جدیدی در :appName ایجاد کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',
	
	
	// post_deleted
	'post_deleted_title'               => 'لیست شما حذف شده است',
	'post_deleted_content_1'           => 'سلام,',
	'post_deleted_content_2'           => 'فهرست شما ":title" از <a href=":appUrl">:appName</a> در :now حذف شده است.',
	'post_deleted_content_3'           => 'ممنون از اعتمادتون و به زودی میبینمت',
	'post_deleted_content_4'           => 'PS: این یک ایمیل خودکار است، لطفاً پاسخ ندهید.',
	
	
	// post_seller_contacted
	'post_seller_contacted_title'      => 'فهرست شما ":title" در :appName',
	'post_seller_contacted_content_1'  => '<strong>اطلاعات تماس:</strong>
<br>Name: :name
<br>Email address: :email
<br>Phone number: :phone',
	'post_seller_contacted_content_2'  => 'این ایمیل در مورد فهرست ":title" که در :appName : <a href=":postUrl">:postUrl</a> ثبت کرده اید برای شما ارسال شده است.',
	'post_seller_contacted_content_3'  => 'توجه: شخصی که با شما تماس گرفته است ایمیل شما را نمی داند زیرا شما پاسخ نخواهید داد.',
	'post_seller_contacted_content_4'  => 'به یاد داشته باشید که همیشه جزئیات شخص تماس خود (نام، آدرس، ...) را بررسی کنید تا مطمئن شوید که در صورت اختلاف، تماسی دارید. به طور کلی، تحویل کالای در دست را انتخاب کنید.',
	'post_seller_contacted_content_5'  => 'مراقب پیشنهادات وسوسه انگیز باشید! زمانی که فقط ایمیل تماس دارید، مراقب درخواست های خارج از کشور باشید. انتقال بانکی پیشنهادی توسط Western Union یا MoneyGram ممکن است مصنوعی باشد.',
	'post_seller_contacted_content_6'  => 'ممنون از اعتمادتون و به زودی میبینمت',
	'post_seller_contacted_content_7'  => 'PS: این یک ایمیل خودکار است، لطفاً پاسخ ندهید.',
	
	
	// user_deleted
	'user_deleted_title'             => 'حساب شما در :appName حذف شده است',
	'user_deleted_content_1'         => 'سلام,',
	'user_deleted_content_2'         => 'حساب شما از <a href=":appUrl">:appName</a> در :now حذف شده است.',
	'user_deleted_content_3'         => 'ممنون از اعتمادتون و به زودی میبینمت',
	'user_deleted_content_4'         => 'PS: این یک ایمیل خودکار است، لطفاً پاسخ ندهید.',
	
	
	// user_activated (new)
	'user_activated_title'           => 'به :appName خوش آمدید !',
	'user_activated_content_1'       => 'به :appName :userName خوش آمدید !',
	'user_activated_content_2'       => 'حساب شما فعال شده است.',
	'user_activated_content_3'       => '<strong>توجه: تیم appName به شما توصیه می کند:</strong>
<br><br>1 - Always beware of advertisers refusing to make you see the good offered for sale or rental,
<br>2 - Never send money by Western Union or other international mandate.
<br><br>If you have any doubt about the seriousness of an advertiser, please contact us immediately. We can then neutralize as quickly as possible and prevent someone less informed do become the victim.',
	'user_activated_content_4'       => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً یک حساب جدید :appName ایجاد کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',
	
	
	// reset_password
	'reset_password_title'           => 'رمز عبور خود را بازنشانی کنید',
	'reset_password_action'          => 'بازنشانی رمز عبور',
	'reset_password_content_1'       => 'شما این ایمیل را دریافت می کنید زیرا ما یک درخواست بازنشانی رمز عبور برای حساب شما دریافت کردیم.',
	'reset_password_content_2'       => 'این پیوند بازنشانی رمز عبور در :expireTimeString منقضی می شود.',
	'reset_password_content_3'       => 'اگر بازنشانی رمز عبور را درخواست نکردید، هیچ اقدام دیگری لازم نیست.',
	
	
	// contact_form
	'contact_form_title'             => 'پیام جدید از :appName',
	
	
	// post_report_sent
	'post_report_sent_title'           => 'گزارش سوء استفاده جدید',
	'Listing URL'                         => 'URL فهرست',
	
	
	// post_archived
	'post_archived_title'              => 'فهرست شما بایگانی شده است',
	'post_archived_content_1'          => 'سلام,',
	'post_archived_content_2'          => 'فهرست شما ":title" از :appName در :now بایگانی شده است.',
	'post_archived_content_3'          => 'می‌توانید آن را با کلیک کردن در اینجا دوباره ارسال کنید: <a href=":repostUrl">:repostUrl</a>',
	'post_archived_content_4'          => 'اگر کاری انجام ندهید، لیست شما برای همیشه در :dateDel حذف خواهد شد.',
	'post_archived_content_5'          => 'ممنون از اعتمادتون و به زودی میبینمت',
	'post_archived_content_6'          => 'PS: این یک ایمیل خودکار است، لطفاً پاسخ ندهید.',
	
	
	// post_will_be_deleted
	'post_will_be_deleted_title'       => 'فهرست شما در روزهای :روز حذف خواهد شد',
	'post_will_be_deleted_content_1'   => 'سلام,',
	'post_will_be_deleted_content_2'   => 'فهرست شما ":title" در روزهای :روز از :appName حذف خواهد شد.',
	'post_will_be_deleted_content_3'   => 'می‌توانید آن را با کلیک کردن در اینجا دوباره ارسال کنید: <a href=":repostUrl">:repostUrl</a>',
	'post_will_be_deleted_content_4'   => 'اگر کاری انجام ندهید، لیست شما برای همیشه در :dateDel حذف خواهد شد.',
	'post_will_be_deleted_content_5'   => 'ممنون از اعتمادتون و به زودی میبینمت',
	'post_will_be_deleted_content_6'   => 'PS: این یک ایمیل خودکار است، لطفاً پاسخ ندهید.',
	
	
	// post_notification
	'post_notification_title'          => 'لیست جدید ارسال شده است',
	'post_notification_content_1'      => 'سلام ادمین,',
	'post_notification_content_2'      => 'کاربر :advertiserName به تازگی یک لیست جدید ارسال کرده است.',
	'post_notification_content_3'      => 'عنوان فهرست: <a href=":postUrl">:title</a><br>پست شده در: :now at :time',
	
	
	// user_notification
	'user_notification_title'        => 'ثبت نام کاربر جدید',
	'user_notification_content_1'    => 'سلام ادمین,',
	'user_notification_content_2'    => ':name به تازگی ثبت نام کرده است.',
	'user_notification_content_3'    => 'ثبت نام در: :now در :time<br>فیلد تأیید: :authField<br>ایمیل: :email<br>تلفن: :phone',
	
	
	// payment_sent
	'payment_sent_title'             => 'با تشکر از پرداخت شما!',
	'payment_sent_content_1'         => 'سلام,',
	'payment_sent_content_2'         => 'ما پرداخت شما را برای فهرست "<a href=":postUrl">:title</a>" دریافت کردیم.',
	'payment_sent_content_3'         => 'متشکرم!',
	
	
	// payment_notification
	'payment_notification_title'     => 'پرداخت جدید ارسال شد',
	'payment_notification_content_1' => 'سلام ادمین,',
	'payment_notification_content_2' => 'کاربر :advertiserName به تازگی بسته ای را برای فهرست "<a href=":postUrl">:title</a>" خود پرداخت کرده است..',
	'payment_notification_content_3' => 'جزئیات پرداخت
	<br><strong>دلیل پرداخت:</strong> فهرست #:adId - :packageName
	<br><strong>مبلغ:</strong> :amount :currency
	<br><strong>روش پرداخت:</strong> :paymentMethodName',
	
	// payment_approved (new)
	'payment_approved_title'     => 'پرداخت شما تایید شده است!',
	'payment_approved_content_1' => 'سلام,',
	'payment_approved_content_2' => 'پرداخت شما برای فهرست "<a href=":postUrl">:title</a>" تأیید شد.',
	'payment_approved_content_3' => 'متشکرم!',
	'payment_approved_content_4' => 'جزئیات پرداخت
<br><strong>Reason of the payment:</strong> Listing #:adId - :packageName
<br><strong>Amount:</strong> :amount :currency
<br><strong>Payment Method:</strong> :paymentMethodName',
	
	
	// reply_form
	'reply_form_title'               => ':موضوع',
	'reply_form_content_1'           => 'سلام,',
	'reply_form_content_2'           => '<strong>شما پاسخی از: :senderName دریافت کرده اید. پیام زیر را ببینید:</strong>',
	
	
	// generated_password
	'generated_password_title'            => 'رمز عبور شما',
	'generated_password_content_1'        => 'سلام :username!',
	'generated_password_content_2'        => 'حساب شما ایجاد شده است.',
	'generated_password_verify_content_3' => 'برای تایید آدرس ایمیل خود روی دکمه زیر کلیک کنید.',
	'generated_password_verify_action'    => 'تایید آدرس پست الکترونیکی',
	'generated_password_content_4'        => 'رمز عبور شما این است: <strong>:randomPassword</strong>',
	'generated_password_login_action'     => 'اکنون وارد شوید!',
	'generated_password_content_6'        => 'شما این ایمیل را دریافت می‌کنید زیرا اخیراً یک حساب جدید :appName ایجاد کرده‌اید یا یک آدرس ایمیل جدید اضافه کرده‌اید. اگر این شما نبودید، لطفاً این ایمیل را نادیده بگیرید.',


];
