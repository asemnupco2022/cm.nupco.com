<?php

namespace rifrocket\LaravelCms\Http\Livewire;

use rifrocket\LaravelCms\Http\Livewire\AdminControllers\AppSettingControllers\AppSettingComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts\AdminLeftMenuComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts\AdminNavBarComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts\AdminRightMenuComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\MediaManagerComponent\AddMediaComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\MediaManagerComponent\EditImageComponent;
use rifrocket\LaravelCms\Http\Livewire\AdminControllers\MediaManagerComponent\ListMediaComponent;
use rifrocket\LaravelCms\Http\Livewire\AuthControllers\LoginComponent;
use Livewire\Livewire;
use rifrocket\LaravelCms\Http\Livewire\CoreHelpers\ToasterComponent;


class LivewireControllerProvider
{
    public static function adminComponentCollection()
    {
        //Login Components
        Livewire::component('livewire.AuthComponent.loginComponent', LoginComponent::class);


        //Admin Layouts Components
        Livewire::component('livewire.AdminControllers.layouts.rightMenu', AdminRightMenuComponent::class);
        Livewire::component('livewire.AdminControllers.layouts.leftMenu', AdminLeftMenuComponent::class);
        Livewire::component('livewire.AdminControllers.layouts.admin_nav', AdminNavBarComponent::class);


        //App Settings Components
        Livewire::component('livewire.AdminControllers.AppSettingComponent.app_settings', AppSettingComponent::class);


        //App Media Manager
        Livewire::component('livewire.AdminControllers.MediaManagerComponent.list_media_manager', ListMediaComponent::class);
        Livewire::component('livewire.AdminControllers.MediaManagerComponent.add_media_manager', AddMediaComponent::class);
        Livewire::component('livewire.AdminControllers.MediaManagerComponent.edit_image_media_manager', EditImageComponent::class);


        //App Notification
        Livewire::component('livewire.CoreHelpers.core-helper-toaster-component', ToasterComponent::class);
    }
}
