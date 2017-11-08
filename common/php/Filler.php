<?php

class Filler
{
    protected $projectConfig;
    protected $profile;
    protected $templateFile;

    /**
     * Content of templateFile, use for fillerBasic
     * @var string
     */
    protected $template;

    protected static $fillers = [
        'basic' => 'fillerBasic',
        'php-file' => 'fillerPhpFile',
    ];

    protected $filler = 'fillerBasic';

    public function __construct(array $projectConfig)
    {
        $this->projectConfig = $projectConfig;
    }


    /**
     * Get method of filler
     * @param string $filler
     * @return string
     * @throws Exception
     */
    public function setFiller($filler)
    {
        if (!array_key_exists($filler, self::$fillers)) {
            throw new Exception('Filler is not supported');
        }

        $this->filler = self::$fillers[$filler];

        return $this;
    }

    /**
     * @param string $templateFile
     * @return $this
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = $templateFile;
        $this->template = file_get_contents($templateFile);

        return $this;
    }


    /**
     * Fill template by data
     * @param array $data
     * @return string
     */
    public function fill(array $data)
    {
        return $this->{$this->filler}($data);
    }

    /**
     * Fill data to template by replace data fields name and value
     * @param array $data
     * @return string
     */
    function fillerBasic($data)
    {
        $prefix = (string)$this->projectConfig['template_profile_prefix'];
        $prefix = $prefix ? $prefix . '_' : '';

        $template = $this->template;

        foreach ($data as $name => $value) {
            $value = @(string)$value;

            $search = $prefix . strtoupper($name);

            $template = str_replace($search, $value, $template);
        }

        return $template;
    }

    /**
     * Call a php file with data
     * @param $data
     * @return string
     */
    function fillerPhpFile($data)
    {
        extract($data, EXTR_PREFIX_ALL, $this->projectConfig['template_profile_prefix']);
        extract($this->projectConfig['project'], EXTR_PREFIX_ALL, '_project');

        ob_start();
        require $this->templateFile;
        return ob_get_clean();
    }
}