<?php

class CLI
{
    protected static $foregroundColors = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37'
    ];
    protected static $backgroundColors = [
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_gray' => '47',
    ];

    /**
     * @var self
     */
    protected static $instance;

    protected $defaultColorProfile = 'normal';

    protected $colorProfiles = [
        'error' => ['red', null],
        'warning' => ['yellow', null],
        'info' => ['light_cyan', null],
        'normal' => [null, null],
    ];

    /**
     * @return CLI
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct(array $colorProfile = null)
    {
        if (is_array($colorProfile)) {
            $this->setColorProfiles($colorProfile);
        }
    }

    public function getColorProfiles()
    {
        return $this->colorProfiles;
    }

    /**
     * @param array $colorProfiles Array with keys are color profile name, value is array of foreground color and
     *                             background color
     *
     * @return $this
     */
    public function setColorProfiles(array $colorProfiles)
    {
        $this->colorProfiles = $colorProfiles;

        return $this;
    }

    /**
     * @param      $profileName
     * @param null $foregroundColor
     * @param null $backgroundColor
     *
     * @return $this
     */
    public function addColorProfile($profileName, $foregroundColor = null, $backgroundColor = null)
    {
        $this->colorProfiles[$profileName] = [$foregroundColor, $backgroundColor];

        return $this;
    }

    /**
     * @param string $colorProfileName
     *
     * @return $this
     * @throws Exception
     */
    public function setDefaultColorProfile($colorProfileName)
    {
        if (!array_key_exists($colorProfileName, $this->colorProfiles)) {
            throw new Exception('Color profile "' . $colorProfileName . '" is not exists');
        }

        $this->defaultColorProfile = $colorProfileName;

        return $this;
    }

    /**
     * @param string      $string
     * @param string|null $foreground_color
     * @param string|null $background_color
     *
     * @return string
     */
    public function getColoredString($string, $foreground_color = null, $background_color = null)
    {
        $colored_string = "";

        // Check if given foreground color found
        if (array_key_exists($foreground_color, self::$foregroundColors)) {
            $colored_string .= "\033[" . self::$foregroundColors[$foreground_color] . "m";
        }
        // Check if given background color found
        if (array_key_exists($background_color, self::$backgroundColors)) {
            $colored_string .= "\033[" . self::$backgroundColors[$background_color] . "m";
        }

        // Add string and end coloring
        $colored_string .= $string . "\033[0m";

        return $colored_string;
    }


    /**
     * Get message colored by color profile
     *
     * @param string $message
     * @param string $colorProfileName
     *
     * @return string
     * @throws Exception
     */
    public function getSayString($message, $colorProfileName)
    {
        $useColor = false;
        if (!array_key_exists($colorProfileName, $this->colorProfiles)) {
            $useColor = array_key_exists($colorProfileName, self::$foregroundColors);

            if (!$useColor) {
                throw new Exception('Color profile "' . $colorProfileName . '" is not exists');
            }
        }

        if ($useColor) {
            return $this->getColoredString($message, $useColor);
        }

        $colorProfile = $this->colorProfiles[$colorProfileName];

        return $this->getColoredString($message, $colorProfile[0], $colorProfile[1]);
    }

    /**
     * Output colored message
     *
     * @param string $message
     * @param string $colorProfileName
     */
    public function say($message, $colorProfileName = 'normal')
    {
        echo $this->getSayString($message, $colorProfileName);
    }

    public function normal($message)
    {
        $this->say($message, 'normal');
    }

    public function info($message)
    {
        $this->say($message, 'info');
    }

    public function warning($message)
    {
        $this->say($message, 'warning');
    }

    public function error($message)
    {
        $this->say($message, 'error');
    }
}