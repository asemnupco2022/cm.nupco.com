<div>

    <!-- Your components HTML -->


    @push('scripts')

        <script>


            document.addEventListener('livewire:load', function () {


                var navbar_dark_skins = [
                    'navbar-primary',
                    'navbar-secondary',
                    'navbar-info',
                    'navbar-success',
                    'navbar-danger',
                    'navbar-indigo',
                    'navbar-purple',
                    'navbar-pink',
                    'navbar-navy',
                    'navbar-lightblue',
                    'navbar-teal',
                    'navbar-cyan',
                    'navbar-dark',
                    'navbar-gray-dark',
                    'navbar-gray'
                ]

                var navbar_light_skins = [
                    'navbar-light',
                    'navbar-warning',
                    'navbar-white',
                    'navbar-orange'
                ]


                var sidebar_colors = [
                    'bg-primary',
                    'bg-warning',
                    'bg-info',
                    'bg-danger',
                    'bg-success',
                    'bg-indigo',
                    'bg-lightblue',
                    'bg-navy',
                    'bg-purple',
                    'bg-fuchsia',
                    'bg-pink',
                    'bg-maroon',
                    'bg-orange',
                    'bg-lime',
                    'bg-teal',
                    'bg-olive'
                ]

                var accent_colors = [
                    'accent-primary',
                    'accent-warning',
                    'accent-info',
                    'accent-danger',
                    'accent-success',
                    'accent-indigo',
                    'accent-lightblue',
                    'accent-navy',
                    'accent-purple',
                    'accent-fuchsia',
                    'accent-pink',
                    'accent-maroon',
                    'accent-orange',
                    'accent-lime',
                    'accent-teal',
                    'accent-olive'
                ]

                var sidebar_skins = [
                    'sidebar-dark-primary',
                    'sidebar-dark-warning',
                    'sidebar-dark-info',
                    'sidebar-dark-danger',
                    'sidebar-dark-success',
                    'sidebar-dark-indigo',
                    'sidebar-dark-lightblue',
                    'sidebar-dark-navy',
                    'sidebar-dark-purple',
                    'sidebar-dark-fuchsia',
                    'sidebar-dark-pink',
                    'sidebar-dark-maroon',
                    'sidebar-dark-orange',
                    'sidebar-dark-lime',
                    'sidebar-dark-teal',
                    'sidebar-dark-olive',
                    'sidebar-light-primary',
                    'sidebar-light-warning',
                    'sidebar-light-info',
                    'sidebar-light-danger',
                    'sidebar-light-success',
                    'sidebar-light-indigo',
                    'sidebar-light-lightblue',
                    'sidebar-light-navy',
                    'sidebar-light-purple',
                    'sidebar-light-fuchsia',
                    'sidebar-light-pink',
                    'sidebar-light-maroon',
                    'sidebar-light-orange',
                    'sidebar-light-lime',
                    'sidebar-light-teal',
                    'sidebar-light-olive'
                ]


                function dark_mode_controllers($Live_object = null) {
                    var $main_header = $('.main-header')
                    var $live_dark_mode = @this.dark_mode;
                    if(@this.dark_mode=='true'){
                        $main_header.attr('class', 'main-header navbar navbar-expand')
                        $main_header.removeClass('navbar-dark').removeClass('navbar-light')
                        $main_header.addClass('navbar-dark')
                    }
                    $.myFunctionName = function ($check) {
                        if ($check == 'true') {
                            $('body').addClass('dark-mode')
                            $('#dark_mode').attr('checked', true)
                        } else {
                            $('body').removeClass('dark-mode')
                            $('#dark_mode').attr('checked', false)
                        }
                    }
                    if ($Live_object != null) {
                        if ($($Live_object).is(':checked')) {
                            $.myFunctionName('true');
                        @this.setThemeSetting({'dark_mode': 'true'});

                        } else {
                            $.myFunctionName('false');
                        @this.setThemeSetting({'dark_mode': 'false'});
                        }
                    } else {
                        $.myFunctionName($live_dark_mode);

                    }
                }

                function text_sm_body_checkbox($Live_object = null) {

                    var $live_meta_body_text = @this.meta_body_text

                    $.bodyTextFunction = function ($check) {
                        if ($check == 'true') {
                            $('body').addClass('text-sm')
                            $('#meta_body_text').attr('checked', true)
                        } else {
                            $('body').removeClass('text-sm')
                            $('#meta_body_text').attr('checked', false)
                        }
                    }
                    if ($Live_object != null) {
                        if ($($Live_object).is(':checked')) {
                            $.bodyTextFunction('true');
                        @this.setThemeSetting({'meta_body_text': 'true'});

                        } else {
                            $.bodyTextFunction('false');
                        @this.setThemeSetting({'meta_body_text': 'false'});
                        }
                    } else {
                        $.bodyTextFunction($live_meta_body_text);

                    }
                }

                function sidebar_fixed_checkbox($Live_object = null) {

                    var $meta_fixed_sidebar = @this.meta_fixed_sidebar

                    $.sidebar_fixedFunction = function ($check) {
                        if ($check == 'true') {
                            $('body').addClass('layout-fixed')
                            $('#meta_fixed_sidebar').attr('checked', true)

                        } else {
                            $('body').removeClass('layout-fixed')
                            $('#meta_fixed_sidebar').attr('checked', false)


                        }

                    }
                    if ($Live_object != null) {
                        if ($($Live_object).is(':checked')) {
                            $.sidebar_fixedFunction('true');
                        @this.setThemeSetting({'meta_fixed_sidebar': 'true'});

                        } else {
                            $.sidebar_fixedFunction('false');
                        @this.setThemeSetting({'meta_fixed_sidebar': 'false'});

                            setTimeout(function(){  location.reload(); },500);
                        }
                    } else {
                        $.sidebar_fixedFunction($meta_fixed_sidebar);

                    }
                }

                function header_fixed_checkbox($Live_object = null) {

                    var $meta_fixed_header = @this.meta_fixed_header

                    $.header_fixedFunction = function ($check) {
                        if ($check == 'true') {
                            $('body').addClass('layout-navbar-fixed')
                            $('#meta_fixed_header').attr('checked', true)
                        } else {
                            $('body').removeClass('layout-navbar-fixed')
                            $('#meta_fixed_header').attr('checked', false)
                        }
                    }
                    if ($Live_object != null) {
                        if ($($Live_object).is(':checked')) {
                            $.header_fixedFunction('true');
                        @this.setThemeSetting({'meta_fixed_header': 'true'});

                        } else {
                            $.header_fixedFunction('false');
                        @this.setThemeSetting({'meta_fixed_header': 'false'});
                        }
                    } else {
                        $.header_fixedFunction($meta_fixed_header);

                    }
                }




                function legacy_sidebar_container($Live_object = null) {

                    var $meta_sidebar_style = @this.meta_sidebar_style
                    $.meta_sidebar_styleFunction = function ($check) {
                        if ($check == 'true') {
                            $('.nav-sidebar').addClass('nav-legacy')
                            $('#meta_sidebar_style').attr('checked', true)
                        } else {
                            $('.nav-sidebar').removeClass('nav-legacy')
                            $('#meta_sidebar_style').attr('checked', false)
                        }
                    }
                    if ($Live_object != null) {
                        if ($($Live_object).is(':checked')) {
                            $.meta_sidebar_styleFunction('true');
                        @this.setThemeSetting({'meta_sidebar_style': 'true'});

                        } else {
                            $.meta_sidebar_styleFunction('false');
                        @this.setThemeSetting({'meta_sidebar_style': 'false'});
                        }
                    } else {
                        $.meta_sidebar_styleFunction($meta_sidebar_style);

                    }
                }

                function navbar_variants_colors($Live_object = null) {

                    var $NavbarVariants = @this.NavbarVariants
                    $.navbar_variants_colorsFunction = function ($check, color) {
                        var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins)
                        var $main_header = $('.main-header')
                        $main_header.removeClass('navbar-dark').removeClass('navbar-light')
                        navbar_all_colors.forEach(function (color) {
                            $main_header.removeClass(color)
                        })

                        if ($check == 'true') {
                            if (navbar_dark_skins.indexOf(color) > -1) {
                                $main_header.addClass('navbar-dark')
                            @this.setThemeSetting({'NavbarVariants': 'navbar-dark ' + color});
                            } else {
                                $main_header.addClass('navbar-light')
                            @this.setThemeSetting({'NavbarVariants': 'navbar-light ' + color});
                            }
                        } else {
                            if (navbar_dark_skins.indexOf(color) > -1) {
                                $main_header.addClass('navbar-dark')
                            } else {
                                $main_header.addClass('navbar-light')
                            }
                        }


                        $main_header.addClass(color)



                    }
                    if ($Live_object != null) {
                        $.navbar_variants_colorsFunction('true', $Live_object);
                    } else {
                        $.navbar_variants_colorsFunction('false', $NavbarVariants);

                    }
                }


                function accent_color_variants($Live_object = null) {

                    var $AccentColorVariants = @this.AccentColorVariants
                    $.navbar_variants_colorsFunction = function ($check, color) {
                        var accent_class = color
                        var $body = $('body')
                        accent_colors.forEach(function (skin) {
                            $body.removeClass(skin)
                        })

                        if (@this.dark_mode == 'true') {
                            var sidebar_class = 'sidebar-dark-warning';
                            $body.addClass('accent-warning')
                        } else if ($check == 'true') {
                        @this.setThemeSetting({'AccentColorVariants': accent_class});
                            $body.addClass(accent_class)
                        }

                    }
                    if ($Live_object != null) {
                        $.navbar_variants_colorsFunction('true', $Live_object);
                    } else {
                        $.navbar_variants_colorsFunction('false', $AccentColorVariants);
                    }
                }


                function brand_logo_variants($Live_object = null) {

                    var $BrandLogoVariants = @this.BrandLogoVariants
                    $.brand_logo_variantsFunction = function ($check, color) {
                        var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins)
                        var logo_skins = navbar_all_colors
                        var $logo = $('.brand-link')
                        logo_skins.forEach(function (skin) {
                            $logo.removeClass(skin)
                        })

                        if (@this.dark_mode == 'true') {
                            $logo.addClass('navbar-gray-dark')
                        } else if ($check == 'true') {
                        @this.setThemeSetting({'BrandLogoVariants': color});
                            $logo.addClass(color)
                        }else{
                            $logo.addClass(color)
                        }


                    }
                    if ($Live_object != null) {
                        $.brand_logo_variantsFunction('true', $Live_object);
                    } else {
                        $.brand_logo_variantsFunction('false', $BrandLogoVariants);
                    }
                }


                function sidebar_variants($Live_object = null, $mode) {

                    var $sidebar = @this.sidebar;
                    var $sidebarDarkMode = @this.sidebarDarkMode;
                    $.sidebar_variantstsFunction = function ($check, color, sidebarDarkMode) {


                        if (@this.dark_mode == 'true') {
                            var sidebar_class = 'sidebar-dark-warning';
                        }else if ($check == 'true') {
                            if (sidebarDarkMode == 'true') {

                                var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
                            @this.setThemeSetting({'side_dark_mode': 'true', 'DarkSidebarVariants': sidebar_class});

                            } else {

                                var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
                            @this.setThemeSetting({'side_dark_mode': 'false', 'LightSidebarVariants': sidebar_class});


                            }


                        } else {
                            var sidebar_class = color

                        }




                        var $sidebar = $('.main-sidebar')
                        sidebar_skins.forEach(function (skin) {
                            $sidebar.removeClass(skin)

                        })


                        $sidebar.addClass(sidebar_class)
                    }
                    if ($Live_object != null) {
                        $.sidebar_variantstsFunction('true', $Live_object, $mode);
                    } else {
                        $.sidebar_variantstsFunction('false', $sidebar, $sidebarDarkMode);

                    }
                }


                $(document).ready(function () {

                    text_sm_body_checkbox();
                    legacy_sidebar_container();
                    sidebar_fixed_checkbox()
                    navbar_variants_colors();
                    accent_color_variants();
                    brand_logo_variants();
                    sidebar_variants();
                    dark_mode_controllers();
                    header_fixed_checkbox()
                });


                /**
                 * AdminLTE Demo Menu
                 * ------------------
                 * You should not use this file in production.
                 * This file is for demo purposes only.
                 */

                /* eslint-disable camelcase */

                (function ($) {
                    'use strict'

                    var $sidebar = $('.control-sidebar')
                    var $container = $('<div />', {
                        class: 'p-3 control-sidebar-content'
                    })

                    $sidebar.append($container)


                    var menuTitel = @this.app_company
                    $container.append(
                        '<h5> Customize ' + menuTitel + '  </h5><hr class="mb-2"/>'
                    )

                    var $text_sm_body_checkbox = $('<input />', {
                        type: 'checkbox',
                        value: 1,
                        checked: $('body').hasClass('text-sm'),
                        class: 'mr-1 custom-control-input',
                        style: 'width: 1.4rem; z-index:1',
                        id: 'meta_body_text'
                    }).on('click', function () {
                        text_sm_body_checkbox($(this));
                    })
                    var $text_sm_body_container = $('<div />', {class: 'mb-1 custom-control custom-switch '}).append($text_sm_body_checkbox).append('<span class="custom-control-label" >Body small text</span>')
                    $container.append($text_sm_body_container)


                    var $sidebar_fixed_checkbox = $('<input />', {
                        type: 'checkbox',
                        value: 1,
                        checked: $('body').hasClass('layout-fixed'),
                        class: 'mr-1 custom-control-input',
                        style: 'width: 1.4rem; z-index:1',
                        id: 'meta_fixed_sidebar'
                    }).on('click', function () {
                        sidebar_fixed_checkbox($(this))
                        $(window).trigger('resize')
                        $(window).trigger('reload')
                    })
                    var $sidebar_fixed_container = $('<div />', { class: 'mb-1 custom-control custom-switch ' }).append($sidebar_fixed_checkbox).append('<span class="custom-control-label" >Fixed sidebar</span>')
                    $container.append($sidebar_fixed_container)


                    var $header_fixed_checkbox = $('<input />', {
                        type: 'checkbox',
                        value: 1,
                        checked: $('body').hasClass('layout-navbar-fixed'),
                        class: 'mr-1 custom-control-input',
                        style: 'width: 1.4rem; z-index:1',
                        id: 'meta_fixed_header'
                    }).on('click', function () {
                        header_fixed_checkbox($(this))
                    })
                    var $header_fixed_container = $('<div />', { class: 'mb-1 custom-control custom-switch ' }).append($header_fixed_checkbox).append('<span class="custom-control-label" >Fixed header</span>')
                    $container.append($header_fixed_container)


                    var $legacy_sidebar_checkbox = $('<input />', {
                        type: 'checkbox',
                        value: 1,
                        checked: $('.nav-sidebar').hasClass('nav-legacy'),
                        class: 'mr-1 custom-control-input',
                        style: 'width: 1.4rem; z-index:1',
                        id: 'meta_sidebar_style'
                    }).on('click', function () {
                        legacy_sidebar_container($(this))
                    })
                    var $legacy_sidebar_container = $('<div />', {class: 'mb-1 custom-control custom-switch'}).append($legacy_sidebar_checkbox).append('<span class="custom-control-label" >Sidebar nav legacy</span>')
                    $container.append($legacy_sidebar_container)


                    var $dark_mode_checkbox = $('<input />', {
                        type: 'checkbox',
                        value: 1,
                        checked: $('body').hasClass('dark-mode'),
                        class: 'mr-1 custom-control-input',
                        id: 'dark_mode',
                        style: 'width: 1.4rem; z-index:1'
                    }).on('click', function () {
                        dark_mode_controllers($(this))
                    })
                    var $dark_mode_container = $('<div />', {class: 'mb-4 custom-control custom-switch'}).append($dark_mode_checkbox).append(' <span class="custom-control-label" for="customSwitch1">Dark Mode</span>')
                    $container.append($dark_mode_container)



                    function createSkinBlock(colors, callback) {
                        var $block = $('<div />', {
                            class: 'darkModeStatus d-flex flex-wrap mb-3'
                        })

                        colors.forEach(function (color) {
                            var $color = $('<div />', {
                                class: (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-') + ' elevation-2'
                            })

                            $block.append($color)

                            $color.data('color', color)

                            $color.css({
                                width: '40px',
                                height: '20px',
                                borderRadius: '25px',
                                marginRight: 10,
                                marginBottom: 10,
                                opacity: 0.8,
                                cursor: 'pointer'
                            })

                            $color.hover(function () {
                                $(this).css({opacity: 1}).removeClass('elevation-2').addClass('elevation-4')
                            }, function () {
                                $(this).css({opacity: 0.8}).removeClass('elevation-4').addClass('elevation-2')
                            })

                            if (callback) {
                                $color.on('click', callback)
                            }
                        })

                        return $block
                    }

                    $('.product-image-thumb').on('click', function () {
                        var image_element = $(this).find('img')
                        $('.product-image').prop('src', $(image_element).attr('src'))
                        $('.product-image-thumb.active').removeClass('active')
                        $(this).addClass('active')
                    })


                    if (@this.dark_mode == 'true') {
                        $('.darkModeStatus').addClass("hide");
                    } else {
                        $('.darkModeStatus').removeClass("hide");
                    }

                    Livewire.on('darkModeOn', darkModeStatus => {
                    @this.dark_mode
                        = darkModeStatus;
                        if (darkModeStatus == 'true') {
                            text_sm_body_checkbox();
                            legacy_sidebar_container();
                            navbar_variants_colors();
                            accent_color_variants();
                            brand_logo_variants();
                            sidebar_variants();
                            dark_mode_controllers();

                            $('.darkModeStatus').addClass("hide");
                        } else {
                            text_sm_body_checkbox();
                            legacy_sidebar_container();
                            navbar_variants_colors();
                            accent_color_variants();
                            brand_logo_variants();
                            sidebar_variants();
                            dark_mode_controllers();

                            $('.darkModeStatus').removeClass("hide");
                        }

                    })

                })(jQuery)


            })
        </script>


    @endpush
</div>
