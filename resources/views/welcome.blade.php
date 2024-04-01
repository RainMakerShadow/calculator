<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
        </style>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>

    <body class="font-sans dark:bg-white dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-white dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />
            <div class="min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full ml-4">
                    <main class="mt-6">
{{--                        <form method="post" action="{{route('route_name')}}">--}}

                        <div class="grid grid-cols-8">
                            <form class="col-start-1 col-span-2 ml-10 mr-10" method="post" action="/calculation_results">
                                @csrf
                                <div class="relative z-0 w-full mb-5 group ">
                                    <input type="number" name="amount" id="amount" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="amount" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Сумма кредита в злотых</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="indexed_by" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Кредит, индексируемый на </label>
                                    <select id="indexed_by" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="equivalent_in_CHF" id="equivalent_in_CHF" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label id="label_equivalent" for="equivalent_in_CHF" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Эквивалент кредита, взятого банком в CHF</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="exchange_rate_of_CHF" id="exchange_rate_of_CHF" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label id="label_exchange" for="exchange_rate_of_CHF" class=" sm:text-xs peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Курс покупки CHF банком в месяц предоставления кредита</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="number" min="0" name="bank_margin" step="0.01" id="bank_margin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="1.2" />
                                    <label for="bank_margin" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Банковская маржа в %</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="date" name="date" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="date" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Дата предоставления кредита</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="number" min="0" name="investment_period" id="investment_period" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="investment_period" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Срок кредита (месяцы)</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="number" min="0" name="grace_period" id="grace_period" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="grace_period" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Льготный период (месяцы)</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="installment_system" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Система рассрочки погашения кредита</label>
                                    <select id="installment_system" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option value="0">Ровная</option>
                                        <option value="1">Убывающая</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="half_spread_value" id="half_spread_value" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="half_spread_value" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Значение половинного разброса в %</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="date" name="date_of_loan_repayment" id="date_of_loan_repayment" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="date_of_loan_repayment" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Дата погашения кредита в валюте</label>
                                </div>
{{--                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Сохранить</button>--}}
                                <button type="button" id="calculate" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Расчитать</button>
                            </form>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg col-start-3 col-span-6 sm:mr-10">
                                <table class="w-full mb-10 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая ежемесячная сумма погашения кредита
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая ежемесячная сумма погашения кредита
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая сумма долга
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая сумма долга
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма платежей по кредиту, собранная банком
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Валюта
                                        </th>
                                        <th data-content="currency" scope="col" class="px-6 py-3">
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PLN
                                        </th>
                                        <th data-content="currency" scope="col" class="px-6 py-3">
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PLN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PLN
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Текущие расчеты <br> по кредитам в банке
                                        </th>
                                        <td data-content="current_monthly_loan_repayment_amount_currency" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="current_monthly_loan_repayment_amount_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="current_amount_owed" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="current_amount_owed_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td class="px-6 py-4" data-content="total_loan_payments_collected_by_the_bank">
                                            0.00
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                                <table class="w-full mb-10 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма выданного кредита
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма выплат по кредиту в злотых
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма выплат по кредиту в валюте
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая стоимость выплаченных сумм в валюте
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма выплат заемщика:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Подлежит возврату в банк:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Должен быть возвращен заемщику:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая выгода для заемщика (уменьшение долга и/или возврат переплаты)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Урегулирование <br> недействительного <br> кредитного договора
                                        </th>
                                        <td data-content="credit_amount" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_loan_repayments_in_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_loan_repayments_in_currency" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="present_value_of_amounts_paid_in_currency" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_amount_of_the_borrowers_payments"  class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="to_be_returned_to_the_bank" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="must_be_returned_to_the_borrower" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="overall_benefit_to_the_borrower" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="w-full mb-10 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма ежемесячного взноса в счет погашения кредита без учета индексации
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма долга без индексации
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма взносов по кредиту без учета индексации
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Всего выплачено платежей по кредиту
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Должен быть возвращен заемщику:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая выгода для заемщика (уменьшение долга и/или возврат переплаты)

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Расчеты по кредиту <br> без индексации <br> (так называемый де-франкинг)
                                        </th>
                                        <td data-content="amount_of_monthly_installment_to_repay_the_loan_without_indexation"  class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="debt_amount_without_indexation" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="amount_of_loan_installments_without_indexation" class="px-6 py-4">
                                        </td>
                                        <td data-content="total_loan_repayments" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="must_be_returned_to_the_borrower_table_3" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="overall_benefit_to_the_borrower_table_3" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма ежемесячного платежа по кредиту после погашения
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Процентная ставка после погашения
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма долга после погашения
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма платежей по кредиту, причитающихся банку после конвертации
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма взносов и непогашенный долг:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая выгода для заемщика (уменьшение долга и/или возврат переплаты)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Урегулирование в соответствии <br> с предложением FSA по урегулированию
                                            <br>Средняя маржа <br> по кредиту в злотых <br> с даты предоставления кредита
                                        </th>
                                        <td data-content="average_margin" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="amount_of_monthly_loan_payment_after_repayment" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="interest_rate_after_maturity" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="amount_owed_after_repayment" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_loan_payments_due_to_the_bank_after_conversion" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_contributions_and_outstanding_debt" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="overall_benefit_to_the_borrower_table_4" class="px-6 py-4">
                                            $2999
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg col-start-3 col-span-6 sm:mr-10 mt-10">
                                <table class="w-full mb-10 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Текущая сумма долга (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Всего выплачено платежей по кредиту (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Претензия на возврат капитала (PLN):
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Претензия на вознаграждение за так называемое использование капитала (PLN):
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Общая сумма банковских требований (PLN):
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма требований банка после вычета существующих выплат по кредиту (PLN):
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Размер потенциального требования <br> банка о выплате вознаграждения <br> за использование капитала
                                        </th>
                                        <td data-content="current_amount_of_debt_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_loan_repayments_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="credit_amount" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="a_claim_for_remuneration" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_bank_claims_PLN" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td  data-content="amount_of_the_banks_claims" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="w-full mb-10 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Совокупная сумма платежей заемщика:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Процентная ставка по выплаченным суммам по ставке WIBOR 3M
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма требований заемщика
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Размер потенциального требования <br> заемщика о выплате вознаграждения <br> за использование капитала
                                        </th>
                                        <td data-content="aggregate_amount_of_the_borrowers_payments" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="interest_rate_on_amounts_paid_WIBOR_3M_rate" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="amount_of_borrowers_claims" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Корректировка платежей обеих <br> договаривающихся сторон на <br> индекс инфляции
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма кредита (или 1-го транша) (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Сумма последующих траншей (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Всего оплачено банком (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Выплаты заемщику, включая предоплату (PLN)
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Разница (за вычетом надбавки банку) (PLN)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Номинальное значение
                                        </th>
                                        <td data-content="credit_amount_nominal" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_paid_by_the_bank_PLN_nominal" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="payments_to_the_borrower_including_prepayments_PLN_nominal" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="difference_PLN_nominal" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Дополнительная величина <br> инфляционной поправки
                                        </th>
                                        <td data-content="credit_amount_additional" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_paid_by_the_bank_PLN_additional" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="payments_to_the_borrower_including_prepayments_PLN_additional" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="difference_PLN_additional" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Всего
                                        </th>
                                        <td data-content="credit_amount_total" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="total_paid_by_the_bank_PLN_total" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="payments_to_the_borrower_including_prepayments_PLN_total" class="px-6 py-4">
                                            0.00
                                        </td>
                                        <td data-content="difference_PLN_total" class="px-6 py-4">
                                            0.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </main>
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

                    </header>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        @vite('resources/js/app.js')
    </body>
</html>
