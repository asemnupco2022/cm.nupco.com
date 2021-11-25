<?php


namespace rifrocket\LaravelCms\Helpers\Classes;


use Spatie\Permission\Models\Permission;

class LbsConstants
{

    const STATUS_ACTIVE ='active';
    const STATUS_NEW ='new';
    const STATUS_DEACTIVATE ='deactivated';
    const STATUS_SUSPENDED ='suspended';
    const STATUS_DELETED ='deleted';

    const MEMBER_ROLE='super_user';
    const SUPER_ADMIN_ROLE='super_user';
    const CLIENT_ROLE='client';
    const STAFF_ROLE='staff';

    const BASE_ADMIN_ASSETS='vendor/lbs-cms-assets/AdminLteAssets/assets/';
    const BASE_PUBLIC_ASSETS='vendor/lbs-cms-assets/publicAssets/';
    const MEMBER_PROVIDER='lbs_member';
    const ADMIN_PROVIDER='lbs_admin';
    const SPECIAL_CHAR_ARRAY=['pluck'=>'pluck','meta'=>'meta','modelFilter'=>'modelFilter'];

    const SEARCH_CONDTION_BEGINNING='BEGINNING';
    const SEARCH_CONDTION_ANYWHERE='ANYWHERE';

    const CONST_OPERATOR=[
        '='=>'EQUAL',
        '<'=>'LESS THAN',
        '>'=>'GREATER THAN',
        '!='=>'NOT EQUAL',
        'LIKE'=>'LIKE',
    ];

    const CONST_ACTIONS=[
        LbsConstants::STATUS_ACTIVE=>'active',
        LbsConstants::STATUS_DEACTIVATE=>'deactive',
        LbsConstants::STATUS_SUSPENDED=>'suspend',
        LbsConstants::STATUS_DELETED=>'delete',
    ];

    const CONST_PAGE_NUMBERS=[
        "10"=>10,
        "50"=>50,
        "100"=>100,
        "200"=>200,
        "500"=>500,
        "1000"=>1000,
    ];

    const CONST_MAIL_TEMPLATES=[
        'enquiry-email'=>'enquiry-email',
        'expedite-email'=>'expedite-email',
        'warning-email'=>'warning-email',
        'penalty-email'=>'penalty-email',
    ];




}
