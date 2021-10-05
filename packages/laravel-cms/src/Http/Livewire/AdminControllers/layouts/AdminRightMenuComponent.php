<?php


namespace rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts;


use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Models\LbsLteSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AdminRightMenuComponent extends Component
{


    public $app_company;
    public $sidebar;
    public $sidebarDarkMode;
    public $dark_mode;
    public $meta_body_text;
    public $meta_sidebar_style;
    public $meta_fixed_sidebar;
    public $meta_fixed_header;
    public $NavbarVariants;
    public $AccentColorVariants;
    public $BrandLogoVariants;
    public $CardGradientVariants;


    protected $guard = 'admin';
    protected $parentModel = 'lsb_lte_setting';
    protected $taxonomiesOwner = 'lcrm_user_categories';


    public function mount()
    {
        $this->setOnLoad();

    }

    public function setOnLoad()
    {

        if (LaravelCmsFacade::lbs_object_key_exists('side_dark_mode', Session::get('_LbsLteSession')) == 'true') {

            $this->sidebar = LaravelCmsFacade::lbs_object_key_exists('DarkSidebarVariants', Session::get('_LbsLteSession'));
            $this->sidebarDarkMode = "true";
        } else {
            $this->sidebar = LaravelCmsFacade::lbs_object_key_exists('LightSidebarVariants', Session::get('_LbsLteSession'));
            $this->sidebarDarkMode = "false";
        }

        $this->dark_mode = LaravelCmsFacade::lbs_object_key_exists('dark_mode', Session::get('_LbsLteSession'));
        $this->meta_body_text = LaravelCmsFacade::lbs_object_key_exists('meta_body_text', Session::get('_LbsLteSession'));
        $this->meta_sidebar_style = LaravelCmsFacade::lbs_object_key_exists('meta_sidebar_style', Session::get('_LbsLteSession'));
        $this->meta_fixed_sidebar = LaravelCmsFacade::lbs_object_key_exists('meta_fixed_sidebar', Session::get('_LbsLteSession'));
        $this->meta_fixed_header = LaravelCmsFacade::lbs_object_key_exists('meta_fixed_header', Session::get('_LbsLteSession'));
        if ($this->dark_mode == 'false') {
            $this->colorVeriant();
        }

    }

    public function colorVeriant()
    {
        $this->app_company = LaravelCmsFacade::lbs_object_key_exists('app_company', Session::get('_LbsAppSession'));
        $this->NavbarVariants = LaravelCmsFacade::lbs_object_key_exists('NavbarVariants', Session::get('_LbsLteSession'));
        $this->AccentColorVariants = LaravelCmsFacade::lbs_object_key_exists('AccentColorVariants', Session::get('_LbsLteSession'));
        $this->BrandLogoVariants = LaravelCmsFacade::lbs_object_key_exists('BrandLogoVariants', Session::get('_LbsLteSession'));
        $this->CardGradientVariants = LaravelCmsFacade::lbs_object_key_exists('CardGradientVariants', Session::get('_LbsLteSession'));
    }


    public function setThemeSetting($params)
    {
        $requests = $params;
        if (Auth::guard($this->guard)->check()) {
            $lteSetting = LbsLteSetting::where('admin_id', Auth::guard($this->guard)->user()->id)->first();

            if ($lteSetting and !empty($lteSetting)) {
                LaravelCmsFacade::lbs_model_update($lteSetting->id, $requests, $this->parentModel);

            } else {
                $requests['admin_id'] = Auth::guard($this->guard)->user()->id;
                LaravelCmsFacade::lbs_model_insertNew($requests, $this->parentModel);
            }
        }

        $LbsLteSession = LaravelCmsFacade::lbs_get_LteSettingInfo('lsb_lte_setting', ['admin_id' => Auth::guard($this->guard)->user()->id]);
        Session::put('_LbsLteSession', $LbsLteSession);
        Session::save();


        if (Arr::has($requests, 'dark_mode')) {
            $this->setOnLoad();
            $this->dark_mode = LaravelCmsFacade::lbs_object_key_exists('dark_mode', Session::get('_LbsLteSession'));
            $this->emit('darkModeOn', $this->dark_mode);
        }
    }

    public function render()
    {
        return view('LbsViews::livewire.AdminComponent.layouts.admin_right_menu');
    }
}
