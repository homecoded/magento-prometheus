<?php
/**
 * Copyright 2017 littleman.co
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category Littlemanco
 * @package  Littlemanco_Prometheus
 * @license  apache-2.0
 */

/**
 * Creates a metric of the type "gauge"
 */
class Littlemanco_Prometheus_Model_Metrics_Gauge extends Littlemanco_Prometheus_Model_Metrics_Abstract
{
    /**
     * Creates a metric of the type "gauge"
     *
     * @param string $sMetricName   The name of the metric. Of the format vendor_extension_process_type. For example,
     *                              littlemanco_prometheus_apcu_total
     * @param string $sMetricHelp   The help message to provide some context on the metric for debugging
     * @param array  $aLabelTitles  The labels associated with the metric
     */
    public function __construct($sMetricName, $sMetricHelp, array $aLabelTitles = [])
    {
        $this->sMetricName  = $sMetricName;
        $this->sMetricHelp  = $sMetricHelp;
        $this->aLabelTitles = $aLabelTitles;

        $this->getResource()
            ->registerGauge(
                self::S_METRIC_NAMESPACE,
                $this->sMetricName,
                $this->aLabelTitles
            );
    }

    /**
     * Updates the gauge to an arbitrary numeric value.
     *
     * @param float $fValue        The value of $this->sMetricName at the time this is called.
     * @param array $aLabelValues  The values for the previously defined labels
     */
    public function update($fValue, array $aLabelValues = [])
    {
        $this->getResource()
            ->getGauge(self::S_METRIC_NAMESPACE, $this->sMetricName)
            ->set($fValue, $aLabelValues);
    }
}
