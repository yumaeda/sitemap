<?php
namespace Seiya\Common\Xml;

class Sitemap
{
    private $urls;

    /**
     * Constructor
     *
     * @param array $urls
     *     Array of URLs to be written in sitemap.xml
     */
    public function __construct(array $urls)
    {
        $this->urls = $urls;
    }

    /**
     * Generates <url> node XML of Google sitemap.
     *
     * @param string $url
     *   URL written inside the <loc> node.
     */
    private generateUrlNodeXml(string $url)
    {
        $freq    = 'weekly';
        $pri     = '0.5';
        $lastMod = date('Y-m-d');

        $xml  = '<url>';
        $xml .=     '<loc>' . $url . '</loc>';
        $xml .=     '<lastmod>' . $lastMod . '</lastmod>';
        $xml .=     '<changefreq>' . $freq . '</changefreq>';
        $xml .=     '<priority>' . $pri . '</priority>';
        $xml .= '</url>';

        return $xml;
    }

    /**
     * Write Google sitemaps to the specified file.
     *
     * @param string $targetFile
     *     Target location of a sitemap.xml
     */
    public function write(string $targetFile)
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($this->urls as $url)
        {
            $xml .= $this->generateUrlNodeXml($url);
        }

        $xml .= '</urlset>';

        file_put_contents($targetFile, $xml);
    }
}

