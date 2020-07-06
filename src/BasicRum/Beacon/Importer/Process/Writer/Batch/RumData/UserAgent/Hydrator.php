<?php

declare(strict_types=1);

namespace App\BasicRum\Beacon\Importer\Process\Writer\Batch\RumData\UserAgent;

class Hydrator
{
    /**
     * @param $userAgentString
     *
     * @throws \Exception
     */
    public function hydrate(\WhichBrowser\Parser $result, $userAgentString): array
    {
        $userAgent = [];

        $userAgent['user_agent'] = $userAgentString;
        $userAgent['device_model'] = $result->device->getModel();
        $userAgent['device_manufacturer'] = $result->device->getManufacturer();
        $userAgent['browser_name'] = $this->browserName($result);
        $userAgent['browser_version'] = $result->browser->getVersion();
        $userAgent['os_name'] = $result->os->getName();
        $userAgent['os_version'] = $result->os->getVersion();

        return $userAgent;
    }

    /**
     * @return mixed
     */
    private function browserName(\WhichBrowser\Parser $result)
    {
        return isset($result->browser->toArray()['name']) ? $result->browser->toArray()['name'] : $result->browser->getName();
    }
}
