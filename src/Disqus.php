<?php 

namespace Kcdev\Disqus;

use GuzzleHttp\Client;

class Disqus 
{
    /**
     * Disqus username
     * 
     * @var string
     */
    protected $username;

    /**
     * Disqus 
     * 
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Render HTML disqus 
     * 
     * @param array $attributes
     * 
     * @return string 
     */
    public function display($attributes = [])
    {
        $attributes = $this->prepareAttributes($attributes);
        return $this->buildAttributes($attributes);
    }

    /**
     * Prepare HTML atributes and assure that correct classees and attributes for disqus 
     * 
     * @param array $atributes
     * 
     * @return array
     */
    protected function prepareAttributes(array $attributes)
    {
        $url = $this->url($this->requestUri());
        $identifier = 'disqus' . implode('.', explode('/', $this->requestUri()));

        if (!isset($attributes['data-url'])) {
            $attributes['data-url'] = $url;
        }
        if (!isset($attributes['data-identifier'])) {
            $attributes['data-identifier'] = $identifier;
        }

        $attributes['data-username'] = $this->username;

        return $attributes;
    }

    /**
     * Build html attributes 
     * 
     * @param array $attributes
     * 
     * @return string
     */
    protected function buildAttributes(array $attributes)
    {
        $url = $attributes['data-url'];
        $username = $attributes['data-username'];
        $identifier = $attributes['data-identifier'];

        $html = <<<CDATA
<div id="disqus_thread"></div>
<script>
     var disqus_config = function () {
         this.page.url = '$url';
         this.page.identifier = '$identifier';
     };
    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = '//$username.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
CDATA;
        
        return  $html;
    }

    /**
     * Generate a url for the library.
     *
     * @param  string  $uri
     * @return string
     */
    public function url($uri = '') 
    {
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST']);
        return $url . $uri;
    }
    /**
     * Get current page request URI
     *
     * @return string
     */
    public function requestUri() 
    {
        return $_SERVER['REQUEST_URI'];
    }
}
