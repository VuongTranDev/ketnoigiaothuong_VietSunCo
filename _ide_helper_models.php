<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $details
 * @property string|null $address
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Companies $companies
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyCategory> $companyCategory
 * @property-read int|null $company_category_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\News> $news
 * @property-read int|null $news_count
 * @method static \Illuminate\Database\Eloquent\Builder|Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereUpdatedAt($value)
 */
	class Categories extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $content
 * @property int $user_id
 * @property int $new_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News $news
 * @property-read \App\Models\Users $users
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereNewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUserId($value)
 */
	class Comments extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $representative
 * @property string|null $company_name
 * @property string|null $short_name
 * @property string|null $phone_number
 * @property string|null $slug
 * @property string|null $content
 * @property string|null $link
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyCategory> $companyCategory
 * @property-read int|null $company_category_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyImage> $companyImage
 * @property-read int|null $company_image_count
 * @property-read \App\Models\Users $user
 * @method static \Illuminate\Database\Eloquent\Builder|Companies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Companies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Companies query()
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereRepresentative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companies whereUserId($value)
 */
	class Companies extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cate_id
 * @property int $company_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categories $categories
 * @property-read \App\Models\Companies $companies
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCategory whereUpdatedAt($value)
 */
	class CompanyCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $name
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Companies $companies
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyImage whereUpdatedAt($value)
 */
	class CompanyImage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Provinces $provinces
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Wards> $wards
 * @property-read int|null $wards_count
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereUpdatedAt($value)
 */
	class Districts extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $logo
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $copyright
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne query()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereCopyright($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridOne whereUpdatedAt($value)
 */
	class FooterGridOne extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree query()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridThree whereUrl($value)
 */
	class FooterGridThree extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo query()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterGridTwo whereUrl($value)
 */
	class FooterGridTwo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $icon
 * @property string $name
 * @property string $url
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial query()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterSocial whereUrl($value)
 */
	class FooterSocial extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $footer_grid_two_title
 * @property string|null $footer_grid_three_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle whereFooterGridThreeTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle whereFooterGridTwoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FooterTitle whereUpdatedAt($value)
 */
	class FooterTitle extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $tag_name
 * @property string|null $content
 * @property string|null $image
 * @property int $cate_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categories $categories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comments> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Users $users
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUserId($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Districts> $districts
 * @property-read int|null $districts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereUpdatedAt($value)
 */
	class Provinces extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $content
 * @property int|null $numberstart
 * @property int $company_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Companies $company
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereNumberstart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereUserId($value)
 */
	class Ratings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereUpdatedAt($value)
 */
	class Roles extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property int|null $status
 * @property int $role_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Roles $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Users newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereUpdatedAt($value)
 */
	class Users extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Districts $districts
 * @method static \Illuminate\Database\Eloquent\Builder|Wards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereUpdatedAt($value)
 */
	class Wards extends \Eloquent {}
}

