<?php

/**
 * Example: Admin Overload — OrderExtenderComponent
 *
 * Overloads extend existing Gambio classes using the MainFactory chain.
 * The file must:
 *   1. Be placed in {Module}/Admin/Overloads/{ClassName}/{YourFileName}.inc.php
 *   2. Extend {ClassName}_parent (a pseudo-class resolved by MainFactory)
 *   3. Call parent methods to preserve the chain
 *
 * OrderExtenderComponent is commonly used to add custom tabs, data, or HTML
 * to the admin order detail page.
 *
 * Other commonly used admin overloads:
 *   - AdminApplicationTopExtenderComponent     — runs at top of every admin page
 *   - AdminApplicationBottomExtenderComponent  — runs at bottom of every admin page
 *   - AdminEditProductExtenderComponent        — extends product editing page
 *   - AdminCategoriesExtenderComponent         — extends categories page
 *   - OrdersOverviewColumns                    — adds columns to order overview
 *   - PDFOrderExtenderComponent                — extends PDF invoice generation
 *
 * You can overload ANY class managed by MainFactory — not just the ones listed above.
 * Create the appropriate directory name matching the target class.
 */

// @codingStandardsIgnoreStart
class SkeletonOrderExtender extends SkeletonOrderExtender_parent
// @codingStandardsIgnoreEnd
{
    /**
     * Called during order detail page rendering.
     * Use $this->v_output_buffer to collect HTML output.
     */
    public function proceed()
    {
        // Always call parent::proceed() to preserve the overload chain
        parent::proceed();

        // Example: Add a custom tab to the order detail page
        //
        // $orderId = $this->v_data_array['GET']['oID'] ?? 0;
        //
        // $html = '<div class="skeleton-order-tab">';
        // $html .= '<h3>Skeleton Module Data</h3>';
        // $html .= '<p>Custom data for order #' . (int)$orderId . '</p>';
        // $html .= '</div>';
        //
        // $this->v_output_buffer['below_order_data'] = $html;
    }
}
