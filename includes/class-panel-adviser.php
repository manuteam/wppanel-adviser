<?php


class Panel_adviser
{

    private array $configParams;
    private array $manualParams;

    function __construct()
    {
        add_action('admin_init', [$this, 'adminInit']);
        add_action('in_admin_header', [$this, 'addManualBlock']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    /**
     * Get configurations from json
     * @return $this
     */
    public function loadConfig()
    {
        $fileName = "setup.json";

        if (! file_exists(WPADW_DIR . $fileName)) {
            $this->configParams = [];
            return $this;
        }

        $data = file_get_contents(WPADW_DIR . $fileName);

        $paramsArray = json_decode($data, true);

        $this->configParams = $paramsArray;

        return $this;
    }

    /**
     * Get all allow admin menu items
     * @return mixed
     */
    public function getConfigInclude()
    {
        return $this->configParams['sections_include'];
    }

    /**
     * Get all exclude admin menu items
     * @return mixed
     */
    public function getConfigExclude()
    {
        return $this->configParams['sections_exclude'];
    }

    /**
     * Get URL to manual content JSON
     * @return mixed
     */
    public function getConfigManual()
    {
        return $this->configParams['manual_link'];
    }

    /**
     * Add and remove admin menu items
     * @return boolean
     */
    public function adminInit()
    {
        $this->loadConfig();

        if (empty($this->configParams)) {
            return false;
        }
        if (isset($GLOBALS['menu'])) {
            foreach ($GLOBALS['menu'] as $value) {
                if (!in_array($value[2], $this->getConfigExclude())) {
                    remove_menu_page($value[2]);
                }
            }
        }

        if (!empty($this->getConfigInclude())) {
            foreach ($this->getConfigInclude() as $value) {
                add_menu_page($value[0], $value[1], 'read', $value[2], '', 'dashicons-paperclip', 1);
            }
        }

        return true;

    }

    /**
     * Get manuals content
     * @param ...$params
     * @return $this
     */
    public function loadManual(...$params)
    {
        $configPath = $params[0]['path'];

        $data = file_get_contents($this->getConfigManual() . $configPath);

        if (!$data) {
            return $this;
        }

        $paramsArray = json_decode($data, true);

        $this->manualParams = $paramsArray;

        return $this;
    }

    /**
     * Append manual section with content to admin body top
     * @param $post
     * @return $this|false
     */
    public function addManualBlock( $post )
    {

        $this->loadManual(['path' => 'post.json']);

        $manualContent = $this->manualParams;

        if (empty($manualContent)) {
            return false;
        }

        if ($manualContent['display'] !== 'true'
            || empty($manualContent['sections'])
        ) {
            return false;
        }

        include WPADW_DIR . 'templates/section-manual.php';

        return $this;
    }

    /**
     * Add styles and js to admin
     */
    public function enqueueAssets()
    {
        wp_enqueue_style( WPADW_DOMAIN . '-admin-style', WPADW_URL . '/assets/style.css' );
    }

}