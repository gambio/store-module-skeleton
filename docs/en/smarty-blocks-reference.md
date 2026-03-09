# Smarty Template Blocks Reference

This reference lists all Smarty template blocks available in the Malibu theme (Gambio GX). You can override any of these blocks by placing a template file with the same path in your module's `Shop/Themes/All/` directory.

All template files are located in `themes/Malibu/html/system/` (or the equivalent for other themes). When overriding, place your file at:

```
Shop/Themes/All/system/{template_file}
```

To target a specific theme only:

```
Shop/Themes/Malibu/system/{template_file}
```

## How Block Overriding Works

Gambio uses Smarty's `{block}` system. Each template defines named blocks that child themes or modules can override:

```html
{block name="product_info_price"}
    <div class="price">{$productPrice}</div>
{/block}
```

In your module, you can override a specific block without replacing the entire template:

```html
{extends file="parent:system/product_info_price.html"}

{block name="product_info_price"}
    <div class="price custom-price">{$productPrice}</div>
    <div class="skeleton-badge">Sale</div>
{/block}
```

Use `{$smarty.block.parent}` to include the original block content and add to it:

```html
{block name="product_info_price"}
    {$smarty.block.parent}
    <div class="skeleton-extra-info">Custom content below price</div>
{/block}
```

## Block Reference by Area

The "Total Blocks" column shows how many overridable blocks exist within each template file. The "Main Block" is the primary/outermost block.

### Layout: Base Template

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `index.html` | `index_head` | 17 |

### Layout: HTML Head

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `layout_head.html` | `layout_head` | 20 |

### Layout: Header

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `layout_header.html` | `index_outer_wrapper_header_topbar` | 3 |
| `layout_header_cart.html` | `layout_header_cart` | 5 |
| `layout_header_cart_dropdown.html` | `box_car_dropdown_product` | 20 |
| `layout_header_custom_content.html` | `layout_header_custom_content` | 5 |
| `layout_header_navbar_buttons.html` | `layout_header_navbar_buttons` | 1 |

### Layout: Topbar and Secondary Navigation

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `topbar.html` | `topbar` | 1 |
| `layout_topbar_secondary_navigation.html` | `layout_topbar_secondary_navigation` | 70 |
| `layout_secondary_navigation.html` | `layout_secondary_navigation` | 4 |
| `layout_secondary_navigation_search.html` | `layout_secondary_navigation_search` | 2 |
| `layout_secondary_navigation_countries_dropdown.html` | `layout_secondary_navigation_countries_dropdown` | 2 |
| `layout_secondary_navigation_currencies_dropdown.html` | `layout_secondary_navigation_currencies_dropdown` | 3 |

### Layout: Footer

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `layout_footer.html` | `layout_footer_inside_content1` | 4 |
| `layout_footer_links.html` | `layout_footer_links` | 9 |

### Layout: Breadcrumb

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `layout_breadcrumb.html` | `layout_breadcrumb` | 1 |
| `layout_breadcrumb_content.html` | `layout_breadcrumb_content` | 2 |

### Layout: Sidebar

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `sidebar.html` | `index_inner_wrapper_left_aside` | 3 |
| `layout_left_categories.html` | `layout_left_categories` | 2 |
| `layout_left_categories_static.html` | `layout_left_categories_static` | 11 |

### Layout: Miscellaneous

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `layout_bottom.html` | `layout_bottom` | 6 |
| `layout_box_top.html` | `layout_box_top` | 2 |
| `layout_box_bottom.html` | `layout_box_bottom` | 1 |
| `layout_box_headline_link_top.html` | `layout_box_headline_link_top` | 2 |
| `layout_box_headline_link_bottom.html` | `layout_box_headline_link_bottom` | 1 |
| `layout_box_list_buttons_top.html` | `layout_box_list_buttons_top` | 2 |
| `layout_box_list_buttons_bottom.html` | `layout_box_list_buttons_bottom` | 2 |
| `layout_box_no_headline_top.html` | `layout_box_no_headline_top` | 1 |
| `layout_box_no_headline_bottom.html` | `layout_box_no_headline_bottom` | 1 |
| `layout_page_up.html` | `layout_page_up` | 1 |

### Navigation

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `megadropdown.html` | `megadropdown` | 10 |
| `gm_navigation.html` | `gm_navigation` | 1 |
| `gm_mega_flyover.html` | `gm_mega_flyover` | 2 |

### Homepage

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `home.html` | `home` | 2 |
| `home_new_products.html` | `home_new_products_title` | 3 |
| `home_offered_products.html` | `home_offered_products` | 3 |
| `home_recommended_products_default.html` | `home_recommended_products_default` | 3 |
| `home_recommended_products_overview.html` | `home_recommended_products_overview` | 4 |
| `home_upcoming_products.html` | `home_upcoming_products` | 3 |

### Product Detail Page

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `product_info_template_standard.html` | `product_info_template_standard` | 29 |
| `product_info_product_description.html` | `product_info_product_description` | 31 |
| `product_info_gallery.html` | `product_info_template_standard_images` | 3 |
| `product_info_gallery_main.html` | `product_info_gallery_image` | 2 |
| `product_info_gallery_modal.html` | `product_info_gallery_modal` | 2 |
| `product_info_gallery_swiper.html` | `product_info_gallery_swiper` | 20 |
| `product_info_gallery_swiper_slide.html` | `product_info_gallery_swiper_slide` | 5 |
| `product_info_price.html` | `product_info_price` | 3 |
| `product_info_shipping_time.html` | `product_info_shipping_time_label` | 1 |
| `product_info_model.html` | `product_info_model` | 1 |
| `product_info_product_box_bottom.html` | `product_info_product_box_bottom` | 8 |
| `product_info_product_lists.html` | `product_info_product_lists` | 8 |
| `product_info_graduated_price.html` | `product_info_graduated_price` | 4 |
| `product_info_navigator.html` | `product_info_navigator` | 7 |
| `product_info_cross_selling.html` | `product_info_cross_selling` | 3 |
| `product_info_reverse_cross_selling.html` | `product_info_reverse_cross_selling` | 3 |
| `product_info_related_products.html` | `product_info_related_products` | 4 |
| `product_info_social_share.html` | `product_info_social_share` | 1 |
| `product_info_media.html` | `product_info_media` | 2 |
| `product_info_legal_age.html` | `product_info_legal_age` | 1 |
| `product_info_print.html` | `product_info_print` | 7 |
| `product_info_customizer.html` | `product_info_customizer` | 3 |
| `product_info_customizer_position.html` | `product_info_customizer_position` | 1 |
| `product_info_option_template_product_options_dropdown.html` | `product_info_option_template_product_options_dropdown` | 3 |
| `product_info_option_template_product_options_selection.html` | `product_info_option_template_product_options_selection` | 10 |
| `product_info_option_template_table_listing.html` | `product_info_option_template_table_listing` | 5 |
| `product_info_property_template_combis_table.html` | `product_info_property_template_combis_table` | 3 |
| `product_images_attribute_images.html` | `product_images_attribute_images` | 4 |
| `gm_product_images.html` | `gm_product_images` | 6 |
| `gm_graduated_price.html` | `gm_graduated_prices` | 4 |

### Product Listing / Category

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `product_listing.html` | `product_listing` | 5 |
| `product_listing_main.html` | `product_listing_main` | 4 |
| `product_listing_product.html` | `product_listing_product_price` | 64 |
| `product_listing_filter.html` | `product_listing_filter` | 16 |
| `product_listing_ribbon.html` | `product_listing_ribbon` | 4 |
| `product_listing_swiper.html` | `product_listing_swiper` | 4 |
| `product_listing_hidden_fields.html` | `product_listing_hidden_fields` | 1 |
| `product_listing_manufacturer.html` | `product_listing_manufacturer` | 1 |
| `product_listing_template_product_listing_v1.html` | `product_listing_template_product_listing_v1` | 10 |
| `product_listing_option_template_product_options_dropdown.html` | `product_listing_option_template_product_options_dropdown` | 3 |
| `product_listing_option_template_product_options_selection.html` | `product_listing_option_template_product_options_selection` | 3 |
| `category_description_top.html` | `category_description_top` | 18 |
| `category_description_bottom.html` | `category_description_bottom` | 5 |
| `category_subcategories.html` | `category_subcategories` | 7 |
| `category_listing_template_categorie_listing.html` | `module_categorie_listing` | 9 |

### Shopping Cart

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `cart.html` | `cart` | 15 |
| `cart_empty.html` | `cart_empty` | 1 |
| `cart_messages.html` | `cart_messages` | 1 |
| `cart_totals.html` | `cart_totals` | 3 |
| `cart_order_preview.html` | `cart_order_preview` | 23 |
| `cart_order_preview_item.html` | `cart_order_preview_item` | 70 |
| `cart_order_preview_total.html` | `cart_order_preview_total` | 14 |
| `cart_order_item_properties.html` | `cart_order_item_properties` | 1 |
| `cart_order_coupon.html` | `snippets_shopping_cart_button_redeemgiftcouponcode` | 1 |
| `cart_share.html` | `cart_share` | 8 |
| `cart_shipping_costs_selection.html` | `cart_shipping_costs_selection` | 19 |
| `cart_shipping_costs_shipping_module_selection.html` | `cart_shipping_costs_shipping_module_selection` | 6 |
| `cart_shipping_costs_shipping_weight_information.html` | `cart_shipping_costs_shipping_weight_information` | 4 |
| `cart_voucher.html` | `cart_voucher` | 5 |
| `cart_voucher_modal.html` | `cart_voucher_modal` | 12 |
| `offcanvas_cart.html` | `index_outer_wrapper_header_inside_offcanvas_cart` | 1 |

### Checkout

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `checkout_shipping.html` | `checkout_shipping` | 22 |
| `checkout_shipping_address.html` | `checkout_shipping_address` | 22 |
| `checkout_shipping_modules.html` | `checkout_shipping_modules` | 49 |
| `checkout_payment.html` | `checkout_payment` | 74 |
| `checkout_payment_address.html` | `checkout_payment_address` | 21 |
| `checkout_payment_modules.html` | `checkout_payment_modules` | 16 |
| `checkout_payment_information.html` | `checkout_payment_information` | 1 |
| `checkout_payment_instruction.html` | `checkout_payment_instruction` | 11 |
| `checkout_payment_instruction_paypal_pui.html` | `checkout_payment_instruction_paypal_pui` | 12 |
| `checkout_payment_ipayment.html` | `checkout_payment_ipayment` | 8 |
| `checkout_payment_sepa_mandate.html` | `checkout_payment_sepa_mandate` | 1 |
| `checkout_payment_vrepay_dialog.html` | `checkout_payment_vrepay_dialog` | 7 |
| `checkout_paypal_plus_payment_modules.html` | `checkout_paypal_plus_payment_modules` | 19 |
| `checkout_confirmation.html` | `checkout_confirmation` | 61 |
| `checkout_confirmation_products.html` | `checkout_confirmation_products` | 22 |
| `checkout_confirmation_order_total.html` | `checkout_confirmation_order_total` | 2 |
| `checkout_new_address.html` | `checkout_new_address` | 86 |
| `checkout_process_funnel.html` | `checkout_process_funnel` | 6 |
| `checkout_product_info.html` | `checkout_product_info` | 17 |
| `checkout_success.html` | `checkout_success` | 24 |
| `checkout_success_giftvouchersstatus.html` | `checkout_success_giftvouchersstatus` | 1 |
| `checkout_print_order.html` | `checkout_print_order` | 52 |

### Customer Account

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `account.html` | `account` | 48 |
| `account_edit.html` | `account_edit` | 84 |
| `account_register.html` | `account_register` | 183 |
| `account_register_guest.html` | `checkout_started_if` | 164 |
| `account_change_password.html` | `account_change_password` | 12 |
| `account_delete.html` | `account_delete` | 12 |
| `account_history.html` | `account_history` | 18 |
| `account_history_info.html` | `account_history_info` | 58 |
| `account_history_order.html` | `account_history_order` | 10 |
| `account_password_double_opt_in.html` | `account_password_double_opt_in` | 17 |
| `account_password_set_new_password.html` | `account_password_set_new_password` | 5 |
| `address_book.html` | `address_book` | 24 |
| `address_book_details.html` | `address_book_details` | 108 |
| `address_book_process.html` | `address_book_process` | 14 |
| `address_book_parcelshopfinder.html` | `address_book_parcelshopfinder` | 31 |
| `address_book_parcelshopfinder_result.html` | `address_book_parcelshopfinder_result` | 34 |

### Login / Logout

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `login.html` | `login` | 21 |
| `logout.html` | `logout` | 5 |

### Filters

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `filter.html` | `filter` | 6 |
| `filter_selection_template_checkboxes.html` | `filter_selection_template_checkboxes` | 5 |
| `filter_selection_template_dropdown.html` | `filter_selection_template_dropdown` | 4 |
| `filter_selection_template_links.html` | `filter_selection_template_links` | 5 |
| `filter_selection_template_multiselect.html` | `filter_selection_template_multiselect` | 6 |

### Search

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `search.html` | `search` | 34 |
| `header_live_search.html` | `header_live_search` | 7 |

### Content Boxes (Sidebar Widgets)

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `box_add_a_quickie.html` | `box_add_a_quickie` | 7 |
| `box_admin.html` | `box_admin` | 15 |
| `box_best_sellers.html` | `box_best_sellers` | 15 |
| `box_content_top.html` | `box_content_top` | 17 |
| `box_extrabox.html` | `box_extrabox` | 4 |
| `box_filter.html` | `box_filter` | 9 |
| `box_filter_form_content.html` | `box_filter_form_content` | 17 |
| `box_infobox_dropdown.html` | `box_infobox_dropdown` | 9 |
| `box_information.html` | `box_information` | 6 |
| `box_language_dropdown.html` | `box_language_dropdown` | 2 |
| `box_login.html` | `box_login` | 10 |
| `box_login_dropdown.html` | `box_login_dropdown` | 11 |
| `box_manufacturers.html` | `box_manufacturers` | 5 |
| `box_manufacturers_info.html` | `box_manufacturers_info` | 10 |
| `box_newsletter.html` | `box_newsletter` | 9 |
| `box_order_history.html` | `box_order_history` | 5 |
| `box_recently_viewed.html` | `box_recently_viewed` | 10 |
| `box_search.html` | `box_search` | 10 |
| `box_specials.html` | `box_specials` | 9 |
| `box_whats_new.html` | `box_whats_new` | 10 |

### Content Pages

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `content.html` | `content` | 11 |
| `content_download.html` | `content_download` | 4 |

### Reviews

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `product_reviews.html` | `product_reviews` | 7 |
| `product_reviews_write.html` | `product_reviews_write` | 30 |
| `products_reviews.html` | `products_reviews` | 20 |
| `product_question.html` | `product_question` | 32 |
| `rating_stars.html` | `rating_stars` | 1 |

### Contact / Newsletter / Recommend

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `contact.html` | `contact` | 21 |
| `newsletter.html` | `newsletter` | 29 |
| `recommend.html` | `recommend` | 23 |

### Cookie Consent

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `cookie_bar.html` | `cookie_bar` | 6 |
| `cookie_usage.html` | `cookie_usage` | 6 |

### Popups and Modals

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `modal.html` | `modal` | 1 |
| `lightbox_gallery.html` | `lightbox_gallery` | 6 |
| `popup_content.html` | `popup_content` | 8 |
| `popup_coupon_help.html` | `popup_coupon_help` | 2 |
| `popup_image.html` | `popup_image` | 7 |
| `popup_notification.html` | `popup_notification` | 4 |
| `popup_search_help.html` | `popup_search_help` | 4 |

### Image Slider

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `image_slider.html` | `image_slider` | 1 |
| `image_slider_scripts.html` | `image_slider_scripts` | 1 |
| `slider.html` | `slider_if` | 1 |

### Product Modifiers

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `product_modifiers_template_group.html` | `product_modifiers_template_group` | 1 |
| `modifier_group_type_boxedtext.html` | `modifier_group_type_boxedtext` | 1 |
| `modifier_group_type_dropdown.html` | `modifier_group_type_dropdown` | 1 |
| `modifier_group_type_image.html` | `modifier_group_type_image` | 1 |
| `modifier_group_type_radio.html` | `modifier_group_type_radio` | 1 |
| `modifier_group_type_text.html` | `modifier_group_type_text` | 1 |

### Miscellaneous

| Template | Main Block | Total Blocks |
|----------|------------|--------------|
| `banner.html` | `banner` | 1 |
| `alert_message.html` | `alert_message` | 2 |
| `error_message.html` | `error_message` | 11 |
| `downloads.html` | `downloads` | 8 |
| `offers.html` | `offers` | 5 |
| `pagination.html` | `pagination` | 1 |
| `pagination_info.html` | `pagination_info` | 1 |
| `seen_cheaper.html` | `seen_cheaper` | 53 |
| `shipping_and_payment_matrix.html` | `shipping_and_payment_matrix` | 15 |
| `sitemap.html` | `sitemap` | 1 |
| `voucher_send.html` | `voucher_send` | 40 |
| `wish_list.html` | `wish_list` | 4 |
| `wish_list_order_details.html` | `wish_list_order_details` | 5 |
| `withdrawal_pdf_form.html` | `withdrawal_pdf_form` | 1 |
| `withdrawal_web_form.html` | `withdrawal_web_form` | 89 |
| `callback_service.html` | `callback_service` | 37 |

## Summary

The Malibu theme contains **242 template files** with a total of **3,121 overridable Smarty blocks**.

The templates with the most blocks (and therefore the most granular override options):

| Template | Blocks |
|----------|--------|
| `account_register.html` | 183 |
| `account_register_guest.html` | 164 |
| `address_book_details.html` | 108 |
| `withdrawal_web_form.html` | 89 |
| `checkout_new_address.html` | 86 |
| `account_edit.html` | 84 |
| `checkout_payment.html` | 74 |
| `layout_topbar_secondary_navigation.html` | 70 |
| `cart_order_preview_item.html` | 70 |
| `product_listing_product.html` | 64 |
