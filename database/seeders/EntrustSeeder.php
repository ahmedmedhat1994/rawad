<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();


        $adminRole = Role::create(['name' =>'admin', 'display_name' => 'Administration', 'description' =>'Administrator', 'allowed_route' =>'admin',]);
        $superVisorRole = Role::create(['name' =>'supervisor', 'display_name' => 'Supervisor', 'description' =>'Supervisor', 'allowed_route' =>'admin',]);
        $customerRole = Role::create(['name' =>'customer', 'display_name' => 'Customer', 'description' =>'Customer', 'allowed_route' =>null,]);

        $admin = User::create(['first_name' =>'Admin' , 'last_name' => 'System' , 'email' => 'admin@admin.com' , 'email_verified_at' => now() , 'password' => bcrypt('Firwallmega1'), 'username' => 'admin', 'mobile' =>'01009885650' , 'status' => 1,]);
        $admin->attachRole($adminRole);

        $supervisor = User::create(['first_name' =>'Supervisor' , 'last_name' => 'admin' , 'email' => 'supervisor@admin.com' , 'email_verified_at' => now() , 'password' => bcrypt('Firwallmega1'), 'username' => 'supervisor', 'mobile' =>'01009885250' , 'status' => 1,]);
        $supervisor->attachRole($superVisorRole);

        $customer = User::create(['first_name' =>'Customer' , 'last_name' => 'User' , 'email' => ' ' , 'email_verified_at' => now() , 'password' => bcrypt('Firwallmega1'), 'username' => 'user', 'mobile' =>'01009885850' , 'status' => 1,]);
        $customer->attachRole($customerRole);


        for ($i=1; $i <= 50; $i++)
        {
            $random_customer = User::create(['first_name' =>$faker->firstName , 'last_name' => $faker->lastName , 'email' => $faker->unique()->email , 'email_verified_at' => now() , 'password' => bcrypt('Firwallmega1'), 'username' => $faker->userName, 'mobile' =>$faker->unique()->phoneNumber , 'status' => 1,]);
            $random_customer->attachRole($customerRole);
        }


        $manageMain = Permission::create(['name' => 'main', 'display_name' => trans('sidebar.Dashboard'), 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'icon ni ni-dashboard-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1',]);
        $manageMain->parent_show = $manageMain->id; $manageMain->save();
//        $manageMain = Permission::create(['name' => 'show_main', 'display_name' => trans('sidebar.Dashboard'), 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => null, 'parent' => $manageMain->id, 'parent_original' => $manageMain->id, 'parent_show' => $manageMain->id, 'sidebar_link' => '1', 'appear' => '0']);

        /** product Categories */
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => trans('sidebar.categories'), 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'icon ni ni-archive-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageProductCategories->parent_show = $manageProductCategories->id; $manageProductCategories->save();
//        $showProductCategories = Permission::create(['name' => 'show_product_categories', 'display_name' => trans('sidebar.all categories'), 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createProductCategories = Permission::create(['name' => 'create_product_categories', 'display_name' => trans('sidebar.create category'), 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayProductCategories = Permission::create(['name' => 'display_product_categories', 'display_name' => 'Show Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductCategories = Permission::create(['name' => 'update_product_categories', 'display_name' => 'Update Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductCategories = Permission::create(['name' => 'delete_product_categories', 'display_name' => 'Delete Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

        // PRODUCTS TAGS
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => trans('sidebar.Tags'), 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'icon ni ni-tags-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageTags->parent_show = $manageTags->id; $manageTags->save();
//        $showTags = Permission::create(['name' => 'show_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => '', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createTags = Permission::create(['name' => 'create_tags', 'display_name' => 'Create Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.create', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayTags = Permission::create(['name' => 'display_tags', 'display_name' => 'Show Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.show', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateTags = Permission::create(['name' => 'update_tags', 'display_name' => 'Update Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteTags = Permission::create(['name' => 'delete_tags', 'display_name' => 'Delete Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);

        // PRODUCTS
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => trans('sidebar.products'), 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'icon ni ni-package-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageProducts->parent_show = $manageProducts->id; $manageProducts->save();
//        $showProducts = Permission::create(['name' => 'show_products', 'display_name' => trans('sidebar.all products'), 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => '', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProducts = Permission::create(['name' => 'create_products', 'display_name' => trans('sidebar.create product'), 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayProducts = Permission::create(['name' => 'display_products', 'display_name' => 'Show Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProducts = Permission::create(['name' => 'update_products', 'display_name' => 'Update Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProducts = Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);



        // PRODUCT COUPONS
        $manageProductCoupons = Permission::create(['name' => 'manage_product_coupons', 'display_name' => trans('sidebar.coupons'), 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'icon ni ni-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageProductCoupons->parent_show = $manageProductCoupons->id; $manageProductCoupons->save();
//        $showProductCoupons = Permission::create(['name' => 'show_product_coupons', 'display_name' => 'Coupons', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => '', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createProductCoupons = Permission::create(['name' => 'create_product_coupons', 'display_name' => 'Create Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.create', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayProductCoupons = Permission::create(['name' => 'display_product_coupons', 'display_name' => 'Show Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.show', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductCoupons = Permission::create(['name' => 'update_product_coupons', 'display_name' => 'Update Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.edit', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductCoupons = Permission::create(['name' => 'delete_product_coupons', 'display_name' => 'Delete Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.destroy', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);


        // PRODUCT REVIEWS
        $manageProductReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name' => trans('sidebar.reviews'), 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'icon ni ni-chat-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $manageProductReviews->parent_show = $manageProductReviews->id; $manageProductReviews->save();
//        $showProductReviews = Permission::create(['name' => 'show_product_reviews', 'display_name' => 'Reviews', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => '', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createProductReviews = Permission::create(['name' => 'create_product_reviews', 'display_name' => 'Create Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.create', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayProductReviews = Permission::create(['name' => 'display_product_reviews', 'display_name' => 'Show Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.show', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductReviews = Permission::create(['name' => 'update_product_reviews', 'display_name' => 'Update Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.edit', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductReviews = Permission::create(['name' => 'delete_product_reviews', 'display_name' => 'Delete Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.destroy', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);


        // CUSTOMERS
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => trans('sidebar.customers'), 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'icon ni ni-user-list-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30',]);
        $manageCustomers->parent_show = $manageCustomers->id; $manageCustomers->save();
//        $showCustomers = Permission::create(['name' => 'show_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => '', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createCustomers = Permission::create(['name' => 'create_customers', 'display_name' => 'Create Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayCustomers = Permission::create(['name' => 'display_customers', 'display_name' => 'Show Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateCustomers = Permission::create(['name' => 'update_customers', 'display_name' => 'Update Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteCustomers = Permission::create(['name' => 'delete_customers', 'display_name' => 'Delete Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);

        // CUSTOMER ADDRESSES
        $manageCustomerAddresses = Permission::create(['name' => 'manage_customer_addresses', 'display_name' => trans('sidebar.Customer Addresses'), 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'icon ni ni-map-pin-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '35',]);
        $manageCustomerAddresses->parent_show = $manageCustomerAddresses->id; $manageCustomerAddresses->save();
//        $showCustomerAddresses = Permission::create(['name' => 'show_customer_addresses', 'display_name' => 'Customer Addresses', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'icon material-icons md-location_on', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createCustomerAddresses = Permission::create(['name' => 'create_customer_addresses', 'display_name' => 'Create Address', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.create', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displayCustomerAddresses = Permission::create(['name' => 'display_customer_addresses', 'display_name' => 'Show Address', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.show', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateCustomerAddresses = Permission::create(['name' => 'update_customer_addresses', 'display_name' => 'Update Address', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.edit', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteCustomerAddresses = Permission::create(['name' => 'delete_customer_addresses', 'display_name' => 'Delete Address', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.destroy', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);

        // SUPERVISORS
        $mangeSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' =>trans('sidebar.supervisors'), 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'icon ni ni-user-fill-c', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1000',]);
        $mangeSupervisors->parent_show = $mangeSupervisors->id; $mangeSupervisors->save();
//        $showsupervisors = Permission::create(['name' => 'show_supervisors', 'display_name' => 'supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user', 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $createsupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'Create supervisor', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displaysupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'Show supervisor', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updatesupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'Update supervisor', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deletesupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'Delete supervisor', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);

        // SHIPPING COMPANIES
        $manageShippingCompanies = Permission::create([ 'name' => 'manage_shipping_companies', 'display_name' => trans('sidebar.Shipping Companies'), 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'icon ni ni-package-fill', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '90', ]);
        $manageShippingCompanies->parent_show = $manageShippingCompanies->id; $manageShippingCompanies->save();
//        $showShippingCompanies = Permission::create([ 'name' => 'show_shipping_companies', 'display_name' => 'Shipping Companies', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-truck', 'parent' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'appear' => '0', 'ordering' => '0', ]);
        $createShippingCompanies = Permission::create([ 'name' => 'create_shipping_companies', 'display_name' => 'Create Shipping Company', 'route' => 'shipping_companies/create', 'module' => 'shipping_companies', 'as' => 'shipping_companies.create', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'appear' => '0', 'ordering' => '0',]);
//        $displayShippingCompanies = Permission::create([ 'name' => 'display_shipping_companies', 'display_name' => 'Show Shipping Company', 'route' => 'shipping_companies/{shipping_companies}', 'module' => 'shipping_companies', 'as' => 'shipping_companies.show', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'appear' => '0', 'ordering' => '0',]);
        $updateShippingCompanies = Permission::create([ 'name' => 'update_shipping_companies', 'display_name' => 'Update Shipping Company', 'route' => 'shipping_companies/{shipping_companies}/edit', 'module' => 'shipping_companies', 'as' => 'shipping_companies.edit', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyShippingCompanies = Permission::create([ 'name' => 'delete_shipping_companies', 'display_name' => 'Delete Shipping Company', 'route' => 'shipping_companies/{shipping_companies}', 'module' => 'shipping_companies', 'as' => 'shipping_companies.delete', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'appear' => '0', 'ordering' => '0', ]);



        // PAYMENT METHODS
        $managePaymentMethods = Permission::create([ 'name' => 'manage_payment_methods', 'display_name' => trans('sidebar.Payment Methods'), 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'icon ni ni-sign-mxn-alt', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '100', ]);
        $managePaymentMethods->parent_show = $managePaymentMethods->id; $managePaymentMethods->save();
       // $showPaymentMethods = Permission::create([ 'name' => 'show_payment_methods', 'display_name' => 'Payment Methods', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-dollar-sign', 'parent' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'appear' => '1', 'ordering' => '0', ]);
        $createPaymentMethods = Permission::create([ 'name' => 'create_payment_methods', 'display_name' => 'Create Payment Method', 'route' => 'payment_methods/create', 'module' => 'payment_methods', 'as' => 'payment_methods.create', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'appear' => '0', 'ordering' => '0',]);
      //  $displayPaymentMethods = Permission::create([ 'name' => 'display_payment_methods', 'display_name' => 'Show Payment Method', 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.show', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePaymentMethods = Permission::create([ 'name' => 'update_payment_methods', 'display_name' => 'Update Payment Method', 'route' => 'payment_methods/{payment_methods}/edit', 'module' => 'payment_methods', 'as' => 'payment_methods.edit', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyPaymentMethods = Permission::create([ 'name' => 'delete_payment_methods', 'display_name' => 'Delete Payment Method', 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.delete', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'appear' => '0', 'ordering' => '0', ]);

//        // SUPERVISORS
//        $mangeSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '1000',]);
//        $mangeSupervisors->parent_show = $mangeSupervisors->id; $mangeSupervisors->save();
//        $showsupervisors = Permission::create(['name' => 'show_supervisors', 'display_name' => 'supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user', 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '1']);
//        $createsupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'Create Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $displaysupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'Show Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $updatesupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'Update Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
//        $deletesupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'Delete Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
//
//


    }



}
