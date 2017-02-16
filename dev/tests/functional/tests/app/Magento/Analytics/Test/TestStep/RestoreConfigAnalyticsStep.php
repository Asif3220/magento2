<?php
/**
 * Copyright © 2013-2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Analytics\Test\TestStep;

use Magento\Backend\Test\Page\Adminhtml\Dashboard;
use Magento\Mtf\TestStep\TestStepInterface;
use Magento\Backend\Test\Page\Adminhtml\SystemConfigEdit;
use Magento\Analytics\Test\Page\Adminhtml\ConfigAnalytics;

/**
 * Navigate to menu Stores > Configuration > General > Analytics > General
 *
 */
class RestoreConfigAnalyticsStep implements TestStepInterface
{
    /**
     * Analytics Config settings page.
     *
     * @var configAnalytics
     */
    private $configAnalytics;

    /**
     * Dashboard page.
     *
     * @var Dashboard
     */
    private $dashboard;

    /**
     * System Config page.
     *
     * @var SystemConfigEdit
     */
    private $systemConfigPage;

    /**
     * @param Dashboard $dashboard
     * @param SystemConfigEdit $systemConfigPage
     */
    public function __construct(Dashboard $dashboard, SystemConfigEdit $systemConfigPage)
    {
        $this->dashboard = $dashboard;
        $this->systemConfigPage = $systemConfigPage;
    }

    /**
     * Open Config Analytics settings menu and restore sending data to the Analytics
     *
     * @return void
     */
    public function run()
    {
        $this->dashboard->open();
        $this->dashboard->getMenuBlock()->navigate('Stores > Configuration');
        $this->systemConfigPage->getForm()->getGroup('analytics', 'general');
        $this->configAnalytics->getAnalyticsForm()->enableAnalytics();
        $this->configAnalytics->getAnalyticsForm()->saveConfig();
        $this->dashboard->getMessagesBlock()->assertSuccessMessage();
    }
}
