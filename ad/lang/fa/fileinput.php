<?php
// | => &#124; (for 'ja' file)
return [
	'fileSingle' => 'فایل',
	'filePlural' => 'فایل ها',
	'browseLabel' => 'Browse &hellip;',
	'removeLabel' => 'حذف',
	'removeTitle' => 'فایل های انتخاب شده را پاک کنید',
	'cancelLabel' => 'لغو کنید',
	'cancelTitle' => 'آپلود در حال انجام را لغو کنید',
	'uploadLabel' => 'بارگذاری',
	'uploadTitle' => 'فایل های انتخابی را آپلود کنید',
	'msgNo' => 'خیر',
	'msgNoFilesSelected' => 'هیچ فایلی انتخاب نشده است',
	'msgCancelled' => 'لغو شد',
	'msgPlaceholder' => '{Files} را انتخاب کنید...',
	'msgZoomModalHeading' => 'پیش نمایش تفصیلی',
	'msgFileRequired' => 'شما باید فایلی را برای آپلود انتخاب کنید.',
	'msgSizeTooSmall' => 'فایل "{name}" (<b>{size} کیلوبایت</b>) خیلی کوچک است و باید بزرگتر از <b>{minSize} کیلوبایت</b> باشد.',
	'msgSizeTooLarge' => 'فایل "{name}" (<b>{size} کیلوبایت</b>) از حداکثر اندازه مجاز بارگذاری <b>{maxSize} کیلوبایت</b> بیشتر است.',
	'msgFilesTooLess' => 'شما باید حداقل <b>{n}</b> {files} را برای آپلود انتخاب کنید.',
	'msgFilesTooMany' => 'تعداد فایل‌های انتخاب شده برای آپلود <b>({n})</b> از حداکثر حد مجاز <b>{m}</b> بیشتر است.',
	'msgFileNotFound' => 'فایل "{name}" یافت نشد!',
	'msgFileSecured' => 'محدودیت های امنیتی از خواندن فایل "{name}" جلوگیری می کند.',
	'msgFileNotReadable' => 'فایل "{name}" قابل خواندن نیست.',
	'msgFilePreviewAborted' => 'پیش نمایش فایل برای "{name}" لغو شد.',
	'msgFilePreviewError' => 'هنگام خواندن فایل "{name}" خطایی روی داد.',
	'msgInvalidFileName' => 'نویسه های نامعتبر یا پشتیبانی نشده در نام فایل "{name}".',
	'msgInvalidFileType' => 'نوع نامعتبر برای فایل "{name}". فقط فایل های "{types}" پشتیبانی می شوند.',
	'msgInvalidFileExtension' => 'پسوند نامعتبر برای فایل "{name}". فقط فایل های "{extensions}" پشتیبانی می شوند.',
	'msgFileTypes' => [
		'image' => 'تصویر',
		'html' => 'HTML',
		'text' => 'متن',
		'video' => 'ویدیو',
		'audio' => 'صدا',
		'flash' => 'فلاش',
		'pdf' => 'PDF',
		'object' => 'شی'
	],
	'msgUploadAborted' => 'آپلود فایل متوقف شد',
	'msgUploadThreshold' => 'در حال پردازش...',
	'msgUploadBegin' => 'مقدار دهی اولیه...',
	'msgUploadEnd' => 'انجام شده',
	'msgUploadEmpty' => 'هیچ داده معتبری برای آپلود در دسترس نیست.',
	'msgUploadError' => 'خطا',
	'msgValidationError' => 'خطای اعتبار سنجی',
	'msgLoading' => 'در حال بارگیری فایل {index} از {files} &hellip;',
	'msgProgress' => 'بارگیری فایل {index} از {files} - {name} - {percent}% تکمیل شد.',
	'msgSelected' => '{n} {فایل} انتخاب شد',
	'msgFoldersNotAllowed' => 'فقط فایل‌ها را بکشید و رها کنید! {n} پوشه(های) حذف شده رد شد.',
	'msgImageWidthSmall' => 'عرض فایل تصویری "{name}" باید حداقل {size} پیکسل باشد.',
	'msgImageHeightSmall' => 'ارتفاع فایل تصویری "{name}" باید حداقل {اندازه} پیکسل باشد.',
	'msgImageWidthLarge' => 'عرض فایل تصویری "{name}" نمی تواند از {size} پیکسل بیشتر باشد.',
	'msgImageHeightLarge' => 'ارتفاع فایل تصویری "{name}" نمی تواند از {size} پیکسل بیشتر باشد.',
	'msgImageResizeError' => 'نمی توان ابعاد تصویر را برای تغییر اندازه دریافت کرد.',
	'msgImageResizeException' => 'خطا هنگام تغییر اندازه تصویر.<pre>{errors}</pre>',
	'msgAjaxError' => 'مشکلی در عملیات {operation} پیش آمد. لطفاً بعداً دوباره امتحان کنید!',
	'msgAjaxProgressError' => '{عملیات} ناموفق بود',
	'ajaxOperations' => [
		'deleteThumb' => 'حذف فایل',
		'uploadThumb' => 'آپلود فایل',
		'uploadBatch' => 'آپلود دسته ای فایل',
		'uploadExtra' => 'فرم آپلود داده ها'
	],
	'dropZoneTitle' => 'فایل ها را به اینجا بکشید و رها کنید &hellip;',
	'dropZoneClickTitle' => '<br>(یا برای انتخاب {files} کلیک کنید)',
	'fileActionSettings' => [
		'removeTitle' => 'حذف فایل',
		'uploadTitle' => 'آپلود فایل',
		'uploadRetryTitle' => 'بارگذاری مجدد را امتحان کنید',
		'downloadTitle' => 'دریافت فایل',
		'zoomTitle' => 'دیدن جزئیات',
		'dragTitle' => 'حرکت / تنظیم مجدد',
		'indicatorNewTitle' => 'هنوز آپلود نشده است',
		'indicatorSuccessTitle' => 'آپلود شد',
		'indicatorErrorTitle' => 'خطای آپلود',
		'indicatorLoadingTitle' => 'در حال آپلود ...'
	],
	'previewZoomButtonTitles' => [
		'prev' => 'مشاهده فایل قبلی',
		'next' => 'مشاهده فایل بعدی',
		'toggleheader' => 'هدر را تغییر دهید',
		'fullscreen' => 'تمام صفحه را تغییر دهید',
		'borderless' => 'حالت بدون حاشیه را تغییر دهید',
		'close' => 'بستن پیش نمایش دقیق'
	]
];
