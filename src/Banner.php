<?php
namespace KNVB\Dataservice;

class Banner extends AbstractItem
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $clubid;

    /**
     * @param  string $banner (leaderboard, rectangle, mobile of mobilesplash)
     * @param  string $device (android of ios)
     * @return string The URL to get the content.
     */
    public function getUrl($banner, $device = null){
        $url = 'http://api.knvbdataservice.nl/banner.php';
        $params = [
            'token' => $this->token,
            'clubid' => $this->clubid,
            'banner' => $banner,
        ];

        if($device !== null){
            $params['device'] = $device;
        }

        return $url . '?' . http_build_query($params);
    }

    /**
     * @param  string $banner (leaderboard, rectangle, mobile of mobilesplash)
     * @param  string $device (android of ios)
     * @return string The HTML that renders the banner
     */
    public function getOutput($banner, $device = null)
    {
        return file_get_contents($this->getUrl($banner, $device));
    }
}
