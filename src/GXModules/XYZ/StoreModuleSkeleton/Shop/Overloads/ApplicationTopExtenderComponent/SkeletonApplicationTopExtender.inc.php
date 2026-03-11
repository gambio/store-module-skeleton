<?php

/**
 * Example: Shop Overload — ApplicationTopExtenderComponent
 *
 * This overload runs at the top of every storefront page load.
 * Use it for early initialization, session manipulation, or redirects.
 *
 * Other commonly used shop overloads:
 *   - ApplicationBottomExtenderComponent       — runs at bottom of every page
 *   - HeaderExtenderComponent                  — injects into the HTML header
 *   - CheckoutSuccessExtenderComponent         — extends checkout success page
 *   - CheckoutConfirmationContentControl       — modifies checkout confirmation
 *   - ProductInfoThemeContentView              — modifies product detail rendering
 *   - LoginExtenderComponent                   — extends login process
 *   - LayoutContentControl                     — modifies main layout logic
 *
 * For JavaScript hooks, use the JS ExtenderComponents instead:
 *   - JSGlobalExtenderComponent                — JS on all pages
 *   - JSProductInfoExtenderComponent           — JS on product pages
 *   - JSCheckoutExtenderComponent              — JS on checkout pages
 *   - JSCartExtenderComponent                  — JS on cart page
 */

// @codingStandardsIgnoreStart
class SkeletonApplicationTopExtender extends SkeletonApplicationTopExtender_parent
// @codingStandardsIgnoreEnd
{
    public function proceed()
    {
        parent::proceed();

        // Example: Set a session variable for the module
        //
        // if (!isset($_SESSION['skeleton_initialized'])) {
        //     $_SESSION['skeleton_initialized'] = true;
        // }
    }
}
