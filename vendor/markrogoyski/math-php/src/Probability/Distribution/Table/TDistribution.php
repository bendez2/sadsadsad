<?php

namespace MathPHP\Probability\Distribution\Table;

use MathPHP\Exception;

/**
 * Student's t distribution table of selected values
 *
 * Tables for one sided and two sided,
 * Initial index is degrees of freedom (ν).
 * Second index is confidence level percentage, or alpha value (α).
 *
 * https://en.wikipedia.org/wiki/Student%27s_t-distribution#Table_of_selected_values
 *
 * This table is provided only for completeness. It is common for statistics
 * textbooks to include this table, so this library does as well. It is better
 * to use the StudentT distribution functions when a t value is required.
 */
class TDistribution
{
    /**
     * One-sided t distribution table
     * Confidence level percentages
     * @var array<int|string, array<numeric|string, int|float>>
     */
    private const ONE_SIDED_CONFIDENCE_LEVEL = [
        1          => [ 0 => 0, 75 => 1.000, 80 => 1.376, 85 => 1.963, 90 => 3.078, 95 => 6.314, '97.5' => 12.71, 99 => 31.82, '99.5' => 63.66, '99.75' => 127.3, '99.9' => 318.3, '99.95' => 636.6 ],
        2          => [ 0 => 0, 75 => 0.816, 80 => 1.080, 85 => 1.386, 90 => 1.886, 95 => 2.920, '97.5' => 4.303, 99 => 6.965, '99.5' => 9.925, '99.75' => 14.09, '99.9' => 22.33, '99.95' => 31.60 ],
        3          => [ 0 => 0, 75 => 0.765, 80 => 0.978, 85 => 1.250, 90 => 1.638, 95 => 2.353, '97.5' => 3.182, 99 => 4.541, '99.5' => 5.841, '99.75' => 7.453, '99.9' => 10.21, '99.95' => 12.92 ],
        4          => [ 0 => 0, 75 => 0.741, 80 => 0.941, 85 => 1.190, 90 => 1.533, 95 => 2.132, '97.5' => 2.776, 99 => 3.747, '99.5' => 4.604, '99.75' => 5.598, '99.9' => 7.173, '99.95' => 8.610 ],
        5          => [ 0 => 0, 75 => 0.727, 80 => 0.920, 85 => 1.156, 90 => 1.476, 95 => 2.015, '97.5' => 2.571, 99 => 3.365, '99.5' => 4.032, '99.75' => 4.773, '99.9' => 5.893, '99.95' => 6.869 ],
        6          => [ 0 => 0, 75 => 0.718, 80 => 0.906, 85 => 1.134, 90 => 1.440, 95 => 1.943, '97.5' => 2.447, 99 => 3.143, '99.5' => 3.707, '99.75' => 4.317, '99.9' => 5.208, '99.95' => 5.959 ],
        7          => [ 0 => 0, 75 => 0.711, 80 => 0.896, 85 => 1.119, 90 => 1.415, 95 => 1.895, '97.5' => 2.365, 99 => 2.998, '99.5' => 3.499, '99.75' => 4.029, '99.9' => 4.785, '99.95' => 5.408 ],
        8          => [ 0 => 0, 75 => 0.706, 80 => 0.889, 85 => 1.108, 90 => 1.397, 95 => 1.860, '97.5' => 2.306, 99 => 2.896, '99.5' => 3.355, '99.75' => 3.833, '99.9' => 4.501, '99.95' => 5.041 ],
        9          => [ 0 => 0, 75 => 0.703, 80 => 0.883, 85 => 1.100, 90 => 1.383, 95 => 1.833, '97.5' => 2.262, 99 => 2.821, '99.5' => 3.250, '99.75' => 3.690, '99.9' => 4.297, '99.95' => 4.781 ],
        10         => [ 0 => 0, 75 => 0.700, 80 => 0.879, 85 => 1.093, 90 => 1.372, 95 => 1.812, '97.5' => 2.228, 99 => 2.764, '99.5' => 3.169, '99.75' => 3.581, '99.9' => 4.144, '99.95' => 4.587 ],
        11         => [ 0 => 0, 75 => 0.697, 80 => 0.876, 85 => 1.088, 90 => 1.363, 95 => 1.796, '97.5' => 2.201, 99 => 2.718, '99.5' => 3.106, '99.75' => 3.497, '99.9' => 4.025, '99.95' => 4.437 ],
        12         => [ 0 => 0, 75 => 0.695, 80 => 0.873, 85 => 1.083, 90 => 1.356, 95 => 1.782, '97.5' => 2.179, 99 => 2.681, '99.5' => 3.055, '99.75' => 3.428, '99.9' => 3.930, '99.95' => 4.318 ],
        13         => [ 0 => 0, 75 => 0.694, 80 => 0.870, 85 => 1.079, 90 => 1.350, 95 => 1.771, '97.5' => 2.160, 99 => 2.650, '99.5' => 3.012, '99.75' => 3.372, '99.9' => 3.852, '99.95' => 4.221 ],
        14         => [ 0 => 0, 75 => 0.692, 80 => 0.868, 85 => 1.076, 90 => 1.345, 95 => 1.761, '97.5' => 2.145, 99 => 2.624, '99.5' => 2.977, '99.75' => 3.326, '99.9' => 3.787, '99.95' => 4.140 ],
        15         => [ 0 => 0, 75 => 0.691, 80 => 0.866, 85 => 1.074, 90 => 1.341, 95 => 1.753, '97.5' => 2.131, 99 => 2.602, '99.5' => 2.947, '99.75' => 3.286, '99.9' => 3.733, '99.95' => 4.073 ],
        16         => [ 0 => 0, 75 => 0.690, 80 => 0.865, 85 => 1.071, 90 => 1.337, 95 => 1.746, '97.5' => 2.120, 99 => 2.583, '99.5' => 2.921, '99.75' => 3.252, '99.9' => 3.686, '99.95' => 4.015 ],
        17         => [ 0 => 0, 75 => 0.689, 80 => 0.863, 85 => 1.069, 90 => 1.333, 95 => 1.740, '97.5' => 2.110, 99 => 2.567, '99.5' => 2.898, '99.75' => 3.222, '99.9' => 3.646, '99.95' => 3.965 ],
        18         => [ 0 => 0, 75 => 0.688, 80 => 0.862, 85 => 1.067, 90 => 1.330, 95 => 1.734, '97.5' => 2.101, 99 => 2.552, '99.5' => 2.878, '99.75' => 3.197, '99.9' => 3.610, '99.95' => 3.922 ],
        19         => [ 0 => 0, 75 => 0.688, 80 => 0.861, 85 => 1.066, 90 => 1.328, 95 => 1.729, '97.5' => 2.093, 99 => 2.539, '99.5' => 2.861, '99.75' => 3.174, '99.9' => 3.579, '99.95' => 3.883 ],
        20         => [ 0 => 0, 75 => 0.687, 80 => 0.860, 85 => 1.064, 90 => 1.325, 95 => 1.725, '97.5' => 2.086, 99 => 2.528, '99.5' => 2.845, '99.75' => 3.153, '99.9' => 3.552, '99.95' => 3.850 ],
        21         => [ 0 => 0, 75 => 0.686, 80 => 0.859, 85 => 1.063, 90 => 1.323, 95 => 1.721, '97.5' => 2.080, 99 => 2.518, '99.5' => 2.831, '99.75' => 3.135, '99.9' => 3.527, '99.95' => 3.819 ],
        22         => [ 0 => 0, 75 => 0.686, 80 => 0.858, 85 => 1.061, 90 => 1.321, 95 => 1.717, '97.5' => 2.074, 99 => 2.508, '99.5' => 2.819, '99.75' => 3.119, '99.9' => 3.505, '99.95' => 3.792 ],
        23         => [ 0 => 0, 75 => 0.685, 80 => 0.858, 85 => 1.060, 90 => 1.319, 95 => 1.714, '97.5' => 2.069, 99 => 2.500, '99.5' => 2.807, '99.75' => 3.104, '99.9' => 3.485, '99.95' => 3.767 ],
        24         => [ 0 => 0, 75 => 0.685, 80 => 0.857, 85 => 1.059, 90 => 1.318, 95 => 1.711, '97.5' => 2.064, 99 => 2.492, '99.5' => 2.797, '99.75' => 3.091, '99.9' => 3.467, '99.95' => 3.745 ],
        25         => [ 0 => 0, 75 => 0.684, 80 => 0.856, 85 => 1.058, 90 => 1.316, 95 => 1.708, '97.5' => 2.060, 99 => 2.485, '99.5' => 2.787, '99.75' => 3.078, '99.9' => 3.450, '99.95' => 3.725 ],
        26         => [ 0 => 0, 75 => 0.684, 80 => 0.856, 85 => 1.058, 90 => 1.315, 95 => 1.706, '97.5' => 2.056, 99 => 2.479, '99.5' => 2.779, '99.75' => 3.067, '99.9' => 3.435, '99.95' => 3.707 ],
        27         => [ 0 => 0, 75 => 0.684, 80 => 0.855, 85 => 1.057, 90 => 1.314, 95 => 1.703, '97.5' => 2.052, 99 => 2.473, '99.5' => 2.771, '99.75' => 3.057, '99.9' => 3.421, '99.95' => 3.690 ],
        28         => [ 0 => 0, 75 => 0.683, 80 => 0.855, 85 => 1.056, 90 => 1.313, 95 => 1.701, '97.5' => 2.048, 99 => 2.467, '99.5' => 2.763, '99.75' => 3.047, '99.9' => 3.408, '99.95' => 3.674 ],
        29         => [ 0 => 0, 75 => 0.683, 80 => 0.854, 85 => 1.055, 90 => 1.311, 95 => 1.699, '97.5' => 2.045, 99 => 2.462, '99.5' => 2.756, '99.75' => 3.038, '99.9' => 3.396, '99.95' => 3.659 ],
        30         => [ 0 => 0, 75 => 0.683, 80 => 0.854, 85 => 1.055, 90 => 1.310, 95 => 1.697, '97.5' => 2.042, 99 => 2.457, '99.5' => 2.750, '99.75' => 3.030, '99.9' => 3.385, '99.95' => 3.646 ],
        40         => [ 0 => 0, 75 => 0.681, 80 => 0.851, 85 => 1.050, 90 => 1.303, 95 => 1.684, '97.5' => 2.021, 99 => 2.423, '99.5' => 2.704, '99.75' => 2.971, '99.9' => 3.307, '99.95' => 3.551 ],
        50         => [ 0 => 0, 75 => 0.679, 80 => 0.849, 85 => 1.047, 90 => 1.299, 95 => 1.676, '97.5' => 2.009, 99 => 2.403, '99.5' => 2.678, '99.75' => 2.937, '99.9' => 3.261, '99.95' => 3.496 ],
        60         => [ 0 => 0, 75 => 0.679, 80 => 0.848, 85 => 1.045, 90 => 1.296, 95 => 1.671, '97.5' => 2.000, 99 => 2.390, '99.5' => 2.660, '99.75' => 2.915, '99.9' => 3.232, '99.95' => 3.460 ],
        80         => [ 0 => 0, 75 => 0.678, 80 => 0.846, 85 => 1.043, 90 => 1.292, 95 => 1.664, '97.5' => 1.990, 99 => 2.374, '99.5' => 2.639, '99.75' => 2.887, '99.9' => 3.195, '99.95' => 3.416 ],
        100        => [ 0 => 0, 75 => 0.677, 80 => 0.845, 85 => 1.042, 90 => 1.290, 95 => 1.660, '97.5' => 1.984, 99 => 2.364, '99.5' => 2.626, '99.75' => 2.871, '99.9' => 3.174, '99.95' => 3.390 ],
        120        => [ 0 => 0, 75 => 0.677, 80 => 0.845, 85 => 1.041, 90 => 1.289, 95 => 1.658, '97.5' => 1.980, 99 => 2.358, '99.5' => 2.617, '99.75' => 2.860, '99.9' => 3.160, '99.95' => 3.373 ],
        'infinity' => [ 0 => 0, 75 => 0.674, 80 => 0.842, 85 => 1.036, 90 => 1.282, 95 => 1.645, '97.5' => 1.960, 99 => 2.326, '99.5' => 2.576, '99.75' => 2.807, '99.9' => 3.090, '99.95' => 3.291 ],
    ];

    /**
     * One-sided t distribution table
     * Alphas
     * @var array<int|string, array<numeric|string, int|float>>
     */
    private const ONE_SIDED_ALPHA = [
        1          => [ '0.50' => 0, '0.25' => 1.000, '0.20' => 1.376, '0.15' => 1.963, '0.10' => 3.078, '0.05' => 6.314, '0.025' => 12.71, '0.01' => 31.82, '0.005' => 63.66, '0.0025' => 127.3, '0.001' => 318.3, '0.0005' => 636.6 ],
        2          => [ '0.50' => 0, '0.25' => 0.816, '0.20' => 1.080, '0.15' => 1.386, '0.10' => 1.886, '0.05' => 2.920, '0.025' => 4.303, '0.01' => 6.965, '0.005' => 9.925, '0.0025' => 14.09, '0.001' => 22.33, '0.0005' => 31.60 ],
        3          => [ '0.50' => 0, '0.25' => 0.765, '0.20' => 0.978, '0.15' => 1.250, '0.10' => 1.638, '0.05' => 2.353, '0.025' => 3.182, '0.01' => 4.541, '0.005' => 5.841, '0.0025' => 7.453, '0.001' => 10.21, '0.0005' => 12.92 ],
        4          => [ '0.50' => 0, '0.25' => 0.741, '0.20' => 0.941, '0.15' => 1.190, '0.10' => 1.533, '0.05' => 2.132, '0.025' => 2.776, '0.01' => 3.747, '0.005' => 4.604, '0.0025' => 5.598, '0.001' => 7.173, '0.0005' => 8.610 ],
        5          => [ '0.50' => 0, '0.25' => 0.727, '0.20' => 0.920, '0.15' => 1.156, '0.10' => 1.476, '0.05' => 2.015, '0.025' => 2.571, '0.01' => 3.365, '0.005' => 4.032, '0.0025' => 4.773, '0.001' => 5.893, '0.0005' => 6.869 ],
        6          => [ '0.50' => 0, '0.25' => 0.718, '0.20' => 0.906, '0.15' => 1.134, '0.10' => 1.440, '0.05' => 1.943, '0.025' => 2.447, '0.01' => 3.143, '0.005' => 3.707, '0.0025' => 4.317, '0.001' => 5.208, '0.0005' => 5.959 ],
        7          => [ '0.50' => 0, '0.25' => 0.711, '0.20' => 0.896, '0.15' => 1.119, '0.10' => 1.415, '0.05' => 1.895, '0.025' => 2.365, '0.01' => 2.998, '0.005' => 3.499, '0.0025' => 4.029, '0.001' => 4.785, '0.0005' => 5.408 ],
        8          => [ '0.50' => 0, '0.25' => 0.706, '0.20' => 0.889, '0.15' => 1.108, '0.10' => 1.397, '0.05' => 1.860, '0.025' => 2.306, '0.01' => 2.896, '0.005' => 3.355, '0.0025' => 3.833, '0.001' => 4.501, '0.0005' => 5.041 ],
        9          => [ '0.50' => 0, '0.25' => 0.703, '0.20' => 0.883, '0.15' => 1.100, '0.10' => 1.383, '0.05' => 1.833, '0.025' => 2.262, '0.01' => 2.821, '0.005' => 3.250, '0.0025' => 3.690, '0.001' => 4.297, '0.0005' => 4.781 ],
        10         => [ '0.50' => 0, '0.25' => 0.700, '0.20' => 0.879, '0.15' => 1.093, '0.10' => 1.372, '0.05' => 1.812, '0.025' => 2.228, '0.01' => 2.764, '0.005' => 3.169, '0.0025' => 3.581, '0.001' => 4.144, '0.0005' => 4.587 ],
        11         => [ '0.50' => 0, '0.25' => 0.697, '0.20' => 0.876, '0.15' => 1.088, '0.10' => 1.363, '0.05' => 1.796, '0.025' => 2.201, '0.01' => 2.718, '0.005' => 3.106, '0.0025' => 3.497, '0.001' => 4.025, '0.0005' => 4.437 ],
        12         => [ '0.50' => 0, '0.25' => 0.695, '0.20' => 0.873, '0.15' => 1.083, '0.10' => 1.356, '0.05' => 1.782, '0.025' => 2.179, '0.01' => 2.681, '0.005' => 3.055, '0.0025' => 3.428, '0.001' => 3.930, '0.0005' => 4.318 ],
        13         => [ '0.50' => 0, '0.25' => 0.694, '0.20' => 0.870, '0.15' => 1.079, '0.10' => 1.350, '0.05' => 1.771, '0.025' => 2.160, '0.01' => 2.650, '0.005' => 3.012, '0.0025' => 3.372, '0.001' => 3.852, '0.0005' => 4.221 ],
        14         => [ '0.50' => 0, '0.25' => 0.692, '0.20' => 0.868, '0.15' => 1.076, '0.10' => 1.345, '0.05' => 1.761, '0.025' => 2.145, '0.01' => 2.624, '0.005' => 2.977, '0.0025' => 3.326, '0.001' => 3.787, '0.0005' => 4.140 ],
        15         => [ '0.50' => 0, '0.25' => 0.691, '0.20' => 0.866, '0.15' => 1.074, '0.10' => 1.341, '0.05' => 1.753, '0.025' => 2.131, '0.01' => 2.602, '0.005' => 2.947, '0.0025' => 3.286, '0.001' => 3.733, '0.0005' => 4.073 ],
        16         => [ '0.50' => 0, '0.25' => 0.690, '0.20' => 0.865, '0.15' => 1.071, '0.10' => 1.337, '0.05' => 1.746, '0.025' => 2.120, '0.01' => 2.583, '0.005' => 2.921, '0.0025' => 3.252, '0.001' => 3.686, '0.0005' => 4.015 ],
        17         => [ '0.50' => 0, '0.25' => 0.689, '0.20' => 0.863, '0.15' => 1.069, '0.10' => 1.333, '0.05' => 1.740, '0.025' => 2.110, '0.01' => 2.567, '0.005' => 2.898, '0.0025' => 3.222, '0.001' => 3.646, '0.0005' => 3.965 ],
        18         => [ '0.50' => 0, '0.25' => 0.688, '0.20' => 0.862, '0.15' => 1.067, '0.10' => 1.330, '0.05' => 1.734, '0.025' => 2.101, '0.01' => 2.552, '0.005' => 2.878, '0.0025' => 3.197, '0.001' => 3.610, '0.0005' => 3.922 ],
        19         => [ '0.50' => 0, '0.25' => 0.688, '0.20' => 0.861, '0.15' => 1.066, '0.10' => 1.328, '0.05' => 1.729, '0.025' => 2.093, '0.01' => 2.539, '0.005' => 2.861, '0.0025' => 3.174, '0.001' => 3.579, '0.0005' => 3.883 ],
        20         => [ '0.50' => 0, '0.25' => 0.687, '0.20' => 0.860, '0.15' => 1.064, '0.10' => 1.325, '0.05' => 1.725, '0.025' => 2.086, '0.01' => 2.528, '0.005' => 2.845, '0.0025' => 3.153, '0.001' => 3.552, '0.0005' => 3.850 ],
        21         => [ '0.50' => 0, '0.25' => 0.686, '0.20' => 0.859, '0.15' => 1.063, '0.10' => 1.323, '0.05' => 1.721, '0.025' => 2.080, '0.01' => 2.518, '0.005' => 2.831, '0.0025' => 3.135, '0.001' => 3.527, '0.0005' => 3.819 ],
        22         => [ '0.50' => 0, '0.25' => 0.686, '0.20' => 0.858, '0.15' => 1.061, '0.10' => 1.321, '0.05' => 1.717, '0.025' => 2.074, '0.01' => 2.508, '0.005' => 2.819, '0.0025' => 3.119, '0.001' => 3.505, '0.0005' => 3.792 ],
        23         => [ '0.50' => 0, '0.25' => 0.685, '0.20' => 0.858, '0.15' => 1.060, '0.10' => 1.319, '0.05' => 1.714, '0.025' => 2.069, '0.01' => 2.500, '0.005' => 2.807, '0.0025' => 3.104, '0.001' => 3.485, '0.0005' => 3.767 ],
        24         => [ '0.50' => 0, '0.25' => 0.685, '0.20' => 0.857, '0.15' => 1.059, '0.10' => 1.318, '0.05' => 1.711, '0.025' => 2.064, '0.01' => 2.492, '0.005' => 2.797, '0.0025' => 3.091, '0.001' => 3.467, '0.0005' => 3.745 ],
        25         => [ '0.50' => 0, '0.25' => 0.684, '0.20' => 0.856, '0.15' => 1.058, '0.10' => 1.316, '0.05' => 1.708, '0.025' => 2.060, '0.01' => 2.485, '0.005' => 2.787, '0.0025' => 3.078, '0.001' => 3.450, '0.0005' => 3.725 ],
        26         => [ '0.50' => 0, '0.25' => 0.684, '0.20' => 0.856, '0.15' => 1.058, '0.10' => 1.315, '0.05' => 1.706, '0.025' => 2.056, '0.01' => 2.479, '0.005' => 2.779, '0.0025' => 3.067, '0.001' => 3.435, '0.0005' => 3.707 ],
        27         => [ '0.50' => 0, '0.25' => 0.684, '0.20' => 0.855, '0.15' => 1.057, '0.10' => 1.314, '0.05' => 1.703, '0.025' => 2.052, '0.01' => 2.473, '0.005' => 2.771, '0.0025' => 3.057, '0.001' => 3.421, '0.0005' => 3.690 ],
        28         => [ '0.50' => 0, '0.25' => 0.683, '0.20' => 0.855, '0.15' => 1.056, '0.10' => 1.313, '0.05' => 1.701, '0.025' => 2.048, '0.01' => 2.467, '0.005' => 2.763, '0.0025' => 3.047, '0.001' => 3.408, '0.0005' => 3.674 ],
        29         => [ '0.50' => 0, '0.25' => 0.683, '0.20' => 0.854, '0.15' => 1.055, '0.10' => 1.311, '0.05' => 1.699, '0.025' => 2.045, '0.01' => 2.462, '0.005' => 2.756, '0.0025' => 3.038, '0.001' => 3.396, '0.0005' => 3.659 ],
        30         => [ '0.50' => 0, '0.25' => 0.683, '0.20' => 0.854, '0.15' => 1.055, '0.10' => 1.310, '0.05' => 1.697, '0.025' => 2.042, '0.01' => 2.457, '0.005' => 2.750, '0.0025' => 3.030, '0.001' => 3.385, '0.0005' => 3.646 ],
        40         => [ '0.50' => 0, '0.25' => 0.681, '0.20' => 0.851, '0.15' => 1.050, '0.10' => 1.303, '0.05' => 1.684, '0.025' => 2.021, '0.01' => 2.423, '0.005' => 2.704, '0.0025' => 2.971, '0.001' => 3.307, '0.0005' => 3.551 ],
        50         => [ '0.50' => 0, '0.25' => 0.679, '0.20' => 0.849, '0.15' => 1.047, '0.10' => 1.299, '0.05' => 1.676, '0.025' => 2.009, '0.01' => 2.403, '0.005' => 2.678, '0.0025' => 2.937, '0.001' => 3.261, '0.0005' => 3.496 ],
        60         => [ '0.50' => 0, '0.25' => 0.679, '0.20' => 0.848, '0.15' => 1.045, '0.10' => 1.296, '0.05' => 1.671, '0.025' => 2.000, '0.01' => 2.390, '0.005' => 2.660, '0.0025' => 2.915, '0.001' => 3.232, '0.0005' => 3.460 ],
        80         => [ '0.50' => 0, '0.25' => 0.678, '0.20' => 0.846, '0.15' => 1.043, '0.10' => 1.292, '0.05' => 1.664, '0.025' => 1.990, '0.01' => 2.374, '0.005' => 2.639, '0.0025' => 2.887, '0.001' => 3.195, '0.0005' => 3.416 ],
        100        => [ '0.50' => 0, '0.25' => 0.677, '0.20' => 0.845, '0.15' => 1.042, '0.10' => 1.290, '0.05' => 1.660, '0.025' => 1.984, '0.01' => 2.364, '0.005' => 2.626, '0.0025' => 2.871, '0.001' => 3.174, '0.0005' => 3.390 ],
        120        => [ '0.50' => 0, '0.25' => 0.677, '0.20' => 0.845, '0.15' => 1.041, '0.10' => 1.289, '0.05' => 1.658, '0.025' => 1.980, '0.01' => 2.358, '0.005' => 2.617, '0.0025' => 2.860, '0.001' => 3.160, '0.0005' => 3.373 ],
        'infinity' => [ '0.50' => 0, '0.25' => 0.674, '0.20' => 0.842, '0.15' => 1.036, '0.10' => 1.282, '0.05' => 1.645, '0.025' => 1.960, '0.01' => 2.326, '0.005' => 2.576, '0.0025' => 2.807, '0.001' => 3.090, '0.0005' => 3.291 ],
    ];

    /**
     * Two-sided t distribution table
     * Confidence level percentaces
     * @var array<int|string, array<numeric|string, int|float>>
     */
    private const TWO_SIDED_CONFIDENCE_LEVEL = [
        1          => [ 0 => 0, 50 => 1.000, 60 => 1.376, 70 => 1.963, 80 => 3.078, 90 => 6.314, 95 => 12.71, 98 => 31.82, 99 => 63.66, '99.5' => 127.3, '99.8' => 318.3, '99.9' => 636.6 ],
        2          => [ 0 => 0, 50 => 0.816, 60 => 1.080, 70 => 1.386, 80 => 1.886, 90 => 2.920, 95 => 4.303, 98 => 6.965, 99 => 9.925, '99.5' => 14.09, '99.8' => 22.33, '99.9' => 31.60 ],
        3          => [ 0 => 0, 50 => 0.765, 60 => 0.978, 70 => 1.250, 80 => 1.638, 90 => 2.353, 95 => 3.182, 98 => 4.541, 99 => 5.841, '99.5' => 7.453, '99.8' => 10.21, '99.9' => 12.92 ],
        4          => [ 0 => 0, 50 => 0.741, 60 => 0.941, 70 => 1.190, 80 => 1.533, 90 => 2.132, 95 => 2.776, 98 => 3.747, 99 => 4.604, '99.5' => 5.598, '99.8' => 7.173, '99.9' => 8.610 ],
        5          => [ 0 => 0, 50 => 0.727, 60 => 0.920, 70 => 1.156, 80 => 1.476, 90 => 2.015, 95 => 2.571, 98 => 3.365, 99 => 4.032, '99.5' => 4.773, '99.8' => 5.893, '99.9' => 6.869 ],
        6          => [ 0 => 0, 50 => 0.718, 60 => 0.906, 70 => 1.134, 80 => 1.440, 90 => 1.943, 95 => 2.447, 98 => 3.143, 99 => 3.707, '99.5' => 4.317, '99.8' => 5.208, '99.9' => 5.959 ],
        7          => [ 0 => 0, 50 => 0.711, 60 => 0.896, 70 => 1.119, 80 => 1.415, 90 => 1.895, 95 => 2.365, 98 => 2.998, 99 => 3.499, '99.5' => 4.029, '99.8' => 4.785, '99.9' => 5.408 ],
        8          => [ 0 => 0, 50 => 0.706, 60 => 0.889, 70 => 1.108, 80 => 1.397, 90 => 1.860, 95 => 2.306, 98 => 2.896, 99 => 3.355, '99.5' => 3.833, '99.8' => 4.501, '99.9' => 5.041 ],
        9          => [ 0 => 0, 50 => 0.703, 60 => 0.883, 70 => 1.100, 80 => 1.383, 90 => 1.833, 95 => 2.262, 98 => 2.821, 99 => 3.250, '99.5' => 3.690, '99.8' => 4.297, '99.9' => 4.781 ],
        10         => [ 0 => 0, 50 => 0.700, 60 => 0.879, 70 => 1.093, 80 => 1.372, 90 => 1.812, 95 => 2.228, 98 => 2.764, 99 => 3.169, '99.5' => 3.581, '99.8' => 4.144, '99.9' => 4.587 ],
        11         => [ 0 => 0, 50 => 0.697, 60 => 0.876, 70 => 1.088, 80 => 1.363, 90 => 1.796, 95 => 2.201, 98 => 2.718, 99 => 3.106, '99.5' => 3.497, '99.8' => 4.025, '99.9' => 4.437 ],
        12         => [ 0 => 0, 50 => 0.695, 60 => 0.873, 70 => 1.083, 80 => 1.356, 90 => 1.782, 95 => 2.179, 98 => 2.681, 99 => 3.055, '99.5' => 3.428, '99.8' => 3.930, '99.9' => 4.318 ],
        13         => [ 0 => 0, 50 => 0.694, 60 => 0.870, 70 => 1.079, 80 => 1.350, 90 => 1.771, 95 => 2.160, 98 => 2.650, 99 => 3.012, '99.5' => 3.372, '99.8' => 3.852, '99.9' => 4.221 ],
        14         => [ 0 => 0, 50 => 0.692, 60 => 0.868, 70 => 1.076, 80 => 1.345, 90 => 1.761, 95 => 2.145, 98 => 2.624, 99 => 2.977, '99.5' => 3.326, '99.8' => 3.787, '99.9' => 4.140 ],
        15         => [ 0 => 0, 50 => 0.691, 60 => 0.866, 70 => 1.074, 80 => 1.341, 90 => 1.753, 95 => 2.131, 98 => 2.602, 99 => 2.947, '99.5' => 3.286, '99.8' => 3.733, '99.9' => 4.073 ],
        16         => [ 0 => 0, 50 => 0.690, 60 => 0.865, 70 => 1.071, 80 => 1.337, 90 => 1.746, 95 => 2.120, 98 => 2.583, 99 => 2.921, '99.5' => 3.252, '99.8' => 3.686, '99.9' => 4.015 ],
        17         => [ 0 => 0, 50 => 0.689, 60 => 0.863, 70 => 1.069, 80 => 1.333, 90 => 1.740, 95 => 2.110, 98 => 2.567, 99 => 2.898, '99.5' => 3.222, '99.8' => 3.646, '99.9' => 3.965 ],
        18         => [ 0 => 0, 50 => 0.688, 60 => 0.862, 70 => 1.067, 80 => 1.330, 90 => 1.734, 95 => 2.101, 98 => 2.552, 99 => 2.878, '99.5' => 3.197, '99.8' => 3.610, '99.9' => 3.922 ],
        19         => [ 0 => 0, 50 => 0.688, 60 => 0.861, 70 => 1.066, 80 => 1.328, 90 => 1.729, 95 => 2.093, 98 => 2.539, 99 => 2.861, '99.5' => 3.174, '99.8' => 3.579, '99.9' => 3.883 ],
        20         => [ 0 => 0, 50 => 0.687, 60 => 0.860, 70 => 1.064, 80 => 1.325, 90 => 1.725, 95 => 2.086, 98 => 2.528, 99 => 2.845, '99.5' => 3.153, '99.8' => 3.552, '99.9' => 3.850 ],
        21         => [ 0 => 0, 50 => 0.686, 60 => 0.859, 70 => 1.063, 80 => 1.323, 90 => 1.721, 95 => 2.080, 98 => 2.518, 99 => 2.831, '99.5' => 3.135, '99.8' => 3.527, '99.9' => 3.819 ],
        22         => [ 0 => 0, 50 => 0.686, 60 => 0.858, 70 => 1.061, 80 => 1.321, 90 => 1.717, 95 => 2.074, 98 => 2.508, 99 => 2.819, '99.5' => 3.119, '99.8' => 3.505, '99.9' => 3.792 ],
        23         => [ 0 => 0, 50 => 0.685, 60 => 0.858, 70 => 1.060, 80 => 1.319, 90 => 1.714, 95 => 2.069, 98 => 2.500, 99 => 2.807, '99.5' => 3.104, '99.8' => 3.485, '99.9' => 3.767 ],
        24         => [ 0 => 0, 50 => 0.685, 60 => 0.857, 70 => 1.059, 80 => 1.318, 90 => 1.711, 95 => 2.064, 98 => 2.492, 99 => 2.797, '99.5' => 3.091, '99.8' => 3.467, '99.9' => 3.745 ],
        25         => [ 0 => 0, 50 => 0.684, 60 => 0.856, 70 => 1.058, 80 => 1.316, 90 => 1.708, 95 => 2.060, 98 => 2.485, 99 => 2.787, '99.5' => 3.078, '99.8' => 3.450, '99.9' => 3.725 ],
        26         => [ 0 => 0, 50 => 0.684, 60 => 0.856, 70 => 1.058, 80 => 1.315, 90 => 1.706, 95 => 2.056, 98 => 2.479, 99 => 2.779, '99.5' => 3.067, '99.8' => 3.435, '99.9' => 3.707 ],
        27         => [ 0 => 0, 50 => 0.684, 60 => 0.855, 70 => 1.057, 80 => 1.314, 90 => 1.703, 95 => 2.052, 98 => 2.473, 99 => 2.771, '99.5' => 3.057, '99.8' => 3.421, '99.9' => 3.690 ],
        28         => [ 0 => 0, 50 => 0.683, 60 => 0.855, 70 => 1.056, 80 => 1.313, 90 => 1.701, 95 => 2.048, 98 => 2.467, 99 => 2.763, '99.5' => 3.047, '99.8' => 3.408, '99.9' => 3.674 ],
        29         => [ 0 => 0, 50 => 0.683, 60 => 0.854, 70 => 1.055, 80 => 1.311, 90 => 1.699, 95 => 2.045, 98 => 2.462, 99 => 2.756, '99.5' => 3.038, '99.8' => 3.396, '99.9' => 3.659 ],
        30         => [ 0 => 0, 50 => 0.683, 60 => 0.854, 70 => 1.055, 80 => 1.310, 90 => 1.697, 95 => 2.042, 98 => 2.457, 99 => 2.750, '99.5' => 3.030, '99.8' => 3.385, '99.9' => 3.646 ],
        40         => [ 0 => 0, 50 => 0.681, 60 => 0.851, 70 => 1.050, 80 => 1.303, 90 => 1.684, 95 => 2.021, 98 => 2.423, 99 => 2.704, '99.5' => 2.971, '99.8' => 3.307, '99.9' => 3.551 ],
        50         => [ 0 => 0, 50 => 0.679, 60 => 0.849, 70 => 1.047, 80 => 1.299, 90 => 1.676, 95 => 2.009, 98 => 2.403, 99 => 2.678, '99.5' => 2.937, '99.8' => 3.261, '99.9' => 3.496 ],
        60         => [ 0 => 0, 50 => 0.679, 60 => 0.848, 70 => 1.045, 80 => 1.296, 90 => 1.671, 95 => 2.000, 98 => 2.390, 99 => 2.660, '99.5' => 2.915, '99.8' => 3.232, '99.9' => 3.460 ],
        80         => [ 0 => 0, 50 => 0.678, 60 => 0.846, 70 => 1.043, 80 => 1.292, 90 => 1.664, 95 => 1.990, 98 => 2.374, 99 => 2.639, '99.5' => 2.887, '99.8' => 3.195, '99.9' => 3.416 ],
        100        => [ 0 => 0, 50 => 0.677, 60 => 0.845, 70 => 1.042, 80 => 1.290, 90 => 1.660, 95 => 1.984, 98 => 2.364, 99 => 2.626, '99.5' => 2.871, '99.8' => 3.174, '99.9' => 3.390 ],
        120        => [ 0 => 0, 50 => 0.677, 60 => 0.845, 70 => 1.041, 80 => 1.289, 90 => 1.658, 95 => 1.980, 98 => 2.358, 99 => 2.617, '99.5' => 2.860, '99.8' => 3.160, '99.9' => 3.373 ],
        'infinity' => [ 0 => 0, 50 => 0.674, 60 => 0.842, 70 => 1.036, 80 => 1.282, 90 => 1.645, 95 => 1.960, 98 => 2.326, 99 => 2.576, '99.5' => 2.807, '99.8' => 3.090, '99.9' => 3.291 ],
    ];

    /**
     * Two-sided t distribution table
     * Alphas
     * @var array<int|string, array<numeric|string, int|float>>
     */
    private const TWO_SIDED_ALPHA = [
        1          => [ '1.00' => 0, '0.50' => 1.000, '0.40' => 1.376, '0.30' => 1.963, '0.20' => 3.078, '0.10' => 6.314, '0.05' => 12.71, '0.02' => 31.82, '0.01' => 63.66, '0.005' => 127.3, '0.002' => 318.3, '0.001' => 636.6 ],
        2          => [ '1.00' => 0, '0.50' => 0.816, '0.40' => 1.080, '0.30' => 1.386, '0.20' => 1.886, '0.10' => 2.920, '0.05' => 4.303, '0.02' => 6.965, '0.01' => 9.925, '0.005' => 14.09, '0.002' => 22.33, '0.001' => 31.60 ],
        3          => [ '1.00' => 0, '0.50' => 0.765, '0.40' => 0.978, '0.30' => 1.250, '0.20' => 1.638, '0.10' => 2.353, '0.05' => 3.182, '0.02' => 4.541, '0.01' => 5.841, '0.005' => 7.453, '0.002' => 10.21, '0.001' => 12.92 ],
        4          => [ '1.00' => 0, '0.50' => 0.741, '0.40' => 0.941, '0.30' => 1.190, '0.20' => 1.533, '0.10' => 2.132, '0.05' => 2.776, '0.02' => 3.747, '0.01' => 4.604, '0.005' => 5.598, '0.002' => 7.173, '0.001' => 8.610 ],
        5          => [ '1.00' => 0, '0.50' => 0.727, '0.40' => 0.920, '0.30' => 1.156, '0.20' => 1.476, '0.10' => 2.015, '0.05' => 2.571, '0.02' => 3.365, '0.01' => 4.032, '0.005' => 4.773, '0.002' => 5.893, '0.001' => 6.869 ],
        6          => [ '1.00' => 0, '0.50' => 0.718, '0.40' => 0.906, '0.30' => 1.134, '0.20' => 1.440, '0.10' => 1.943, '0.05' => 2.447, '0.02' => 3.143, '0.01' => 3.707, '0.005' => 4.317, '0.002' => 5.208, '0.001' => 5.959 ],
        7          => [ '1.00' => 0, '0.50' => 0.711, '0.40' => 0.896, '0.30' => 1.119, '0.20' => 1.415, '0.10' => 1.895, '0.05' => 2.365, '0.02' => 2.998, '0.01' => 3.499, '0.005' => 4.029, '0.002' => 4.785, '0.001' => 5.408 ],
        8          => [ '1.00' => 0, '0.50' => 0.706, '0.40' => 0.889, '0.30' => 1.108, '0.20' => 1.397, '0.10' => 1.860, '0.05' => 2.306, '0.02' => 2.896, '0.01' => 3.355, '0.005' => 3.833, '0.002' => 4.501, '0.001' => 5.041 ],
        9          => [ '1.00' => 0, '0.50' => 0.703, '0.40' => 0.883, '0.30' => 1.100, '0.20' => 1.383, '0.10' => 1.833, '0.05' => 2.262, '0.02' => 2.821, '0.01' => 3.250, '0.005' => 3.690, '0.002' => 4.297, '0.001' => 4.781 ],
        10         => [ '1.00' => 0, '0.50' => 0.700, '0.40' => 0.879, '0.30' => 1.093, '0.20' => 1.372, '0.10' => 1.812, '0.05' => 2.228, '0.02' => 2.764, '0.01' => 3.169, '0.005' => 3.581, '0.002' => 4.144, '0.001' => 4.587 ],
        11         => [ '1.00' => 0, '0.50' => 0.697, '0.40' => 0.876, '0.30' => 1.088, '0.20' => 1.363, '0.10' => 1.796, '0.05' => 2.201, '0.02' => 2.718, '0.01' => 3.106, '0.005' => 3.497, '0.002' => 4.025, '0.001' => 4.437 ],
        12         => [ '1.00' => 0, '0.50' => 0.695, '0.40' => 0.873, '0.30' => 1.083, '0.20' => 1.356, '0.10' => 1.782, '0.05' => 2.179, '0.02' => 2.681, '0.01' => 3.055, '0.005' => 3.428, '0.002' => 3.930, '0.001' => 4.318 ],
        13         => [ '1.00' => 0, '0.50' => 0.694, '0.40' => 0.870, '0.30' => 1.079, '0.20' => 1.350, '0.10' => 1.771, '0.05' => 2.160, '0.02' => 2.650, '0.01' => 3.012, '0.005' => 3.372, '0.002' => 3.852, '0.001' => 4.221 ],
        14         => [ '1.00' => 0, '0.50' => 0.692, '0.40' => 0.868, '0.30' => 1.076, '0.20' => 1.345, '0.10' => 1.761, '0.05' => 2.145, '0.02' => 2.624, '0.01' => 2.977, '0.005' => 3.326, '0.002' => 3.787, '0.001' => 4.140 ],
        15         => [ '1.00' => 0, '0.50' => 0.691, '0.40' => 0.866, '0.30' => 1.074, '0.20' => 1.341, '0.10' => 1.753, '0.05' => 2.131, '0.02' => 2.602, '0.01' => 2.947, '0.005' => 3.286, '0.002' => 3.733, '0.001' => 4.073 ],
        16         => [ '1.00' => 0, '0.50' => 0.690, '0.40' => 0.865, '0.30' => 1.071, '0.20' => 1.337, '0.10' => 1.746, '0.05' => 2.120, '0.02' => 2.583, '0.01' => 2.921, '0.005' => 3.252, '0.002' => 3.686, '0.001' => 4.015 ],
        17         => [ '1.00' => 0, '0.50' => 0.689, '0.40' => 0.863, '0.30' => 1.069, '0.20' => 1.333, '0.10' => 1.740, '0.05' => 2.110, '0.02' => 2.567, '0.01' => 2.898, '0.005' => 3.222, '0.002' => 3.646, '0.001' => 3.965 ],
        18         => [ '1.00' => 0, '0.50' => 0.688, '0.40' => 0.862, '0.30' => 1.067, '0.20' => 1.330, '0.10' => 1.734, '0.05' => 2.101, '0.02' => 2.552, '0.01' => 2.878, '0.005' => 3.197, '0.002' => 3.610, '0.001' => 3.922 ],
        19         => [ '1.00' => 0, '0.50' => 0.688, '0.40' => 0.861, '0.30' => 1.066, '0.20' => 1.328, '0.10' => 1.729, '0.05' => 2.093, '0.02' => 2.539, '0.01' => 2.861, '0.005' => 3.174, '0.002' => 3.579, '0.001' => 3.883 ],
        20         => [ '1.00' => 0, '0.50' => 0.687, '0.40' => 0.860, '0.30' => 1.064, '0.20' => 1.325, '0.10' => 1.725, '0.05' => 2.086, '0.02' => 2.528, '0.01' => 2.845, '0.005' => 3.153, '0.002' => 3.552, '0.001' => 3.850 ],
        21         => [ '1.00' => 0, '0.50' => 0.686, '0.40' => 0.859, '0.30' => 1.063, '0.20' => 1.323, '0.10' => 1.721, '0.05' => 2.080, '0.02' => 2.518, '0.01' => 2.831, '0.005' => 3.135, '0.002' => 3.527, '0.001' => 3.819 ],
        22         => [ '1.00' => 0, '0.50' => 0.686, '0.40' => 0.858, '0.30' => 1.061, '0.20' => 1.321, '0.10' => 1.717, '0.05' => 2.074, '0.02' => 2.508, '0.01' => 2.819, '0.005' => 3.119, '0.002' => 3.505, '0.001' => 3.792 ],
        23         => [ '1.00' => 0, '0.50' => 0.685, '0.40' => 0.858, '0.30' => 1.060, '0.20' => 1.319, '0.10' => 1.714, '0.05' => 2.069, '0.02' => 2.500, '0.01' => 2.807, '0.005' => 3.104, '0.002' => 3.485, '0.001' => 3.767 ],
        24         => [ '1.00' => 0, '0.50' => 0.685, '0.40' => 0.857, '0.30' => 1.059, '0.20' => 1.318, '0.10' => 1.711, '0.05' => 2.064, '0.02' => 2.492, '0.01' => 2.797, '0.005' => 3.091, '0.002' => 3.467, '0.001' => 3.745 ],
        25         => [ '1.00' => 0, '0.50' => 0.684, '0.40' => 0.856, '0.30' => 1.058, '0.20' => 1.316, '0.10' => 1.708, '0.05' => 2.060, '0.02' => 2.485, '0.01' => 2.787, '0.005' => 3.078, '0.002' => 3.450, '0.001' => 3.725 ],
        26         => [ '1.00' => 0, '0.50' => 0.684, '0.40' => 0.856, '0.30' => 1.058, '0.20' => 1.315, '0.10' => 1.706, '0.05' => 2.056, '0.02' => 2.479, '0.01' => 2.779, '0.005' => 3.067, '0.002' => 3.435, '0.001' => 3.707 ],
        27         => [ '1.00' => 0, '0.50' => 0.684, '0.40' => 0.855, '0.30' => 1.057, '0.20' => 1.314, '0.10' => 1.703, '0.05' => 2.052, '0.02' => 2.473, '0.01' => 2.771, '0.005' => 3.057, '0.002' => 3.421, '0.001' => 3.690 ],
        28         => [ '1.00' => 0, '0.50' => 0.683, '0.40' => 0.855, '0.30' => 1.056, '0.20' => 1.313, '0.10' => 1.701, '0.05' => 2.048, '0.02' => 2.467, '0.01' => 2.763, '0.005' => 3.047, '0.002' => 3.408, '0.001' => 3.674 ],
        29         => [ '1.00' => 0, '0.50' => 0.683, '0.40' => 0.854, '0.30' => 1.055, '0.20' => 1.311, '0.10' => 1.699, '0.05' => 2.045, '0.02' => 2.462, '0.01' => 2.756, '0.005' => 3.038, '0.002' => 3.396, '0.001' => 3.659 ],
        30         => [ '1.00' => 0, '0.50' => 0.683, '0.40' => 0.854, '0.30' => 1.055, '0.20' => 1.310, '0.10' => 1.697, '0.05' => 2.042, '0.02' => 2.457, '0.01' => 2.750, '0.005' => 3.030, '0.002' => 3.385, '0.001' => 3.646 ],
        40         => [ '1.00' => 0, '0.50' => 0.681, '0.40' => 0.851, '0.30' => 1.050, '0.20' => 1.303, '0.10' => 1.684, '0.05' => 2.021, '0.02' => 2.423, '0.01' => 2.704, '0.005' => 2.971, '0.002' => 3.307, '0.001' => 3.551 ],
        50         => [ '1.00' => 0, '0.50' => 0.679, '0.40' => 0.849, '0.30' => 1.047, '0.20' => 1.299, '0.10' => 1.676, '0.05' => 2.009, '0.02' => 2.403, '0.01' => 2.678, '0.005' => 2.937, '0.002' => 3.261, '0.001' => 3.496 ],
        60         => [ '1.00' => 0, '0.50' => 0.679, '0.40' => 0.848, '0.30' => 1.045, '0.20' => 1.296, '0.10' => 1.671, '0.05' => 2.000, '0.02' => 2.390, '0.01' => 2.660, '0.005' => 2.915, '0.002' => 3.232, '0.001' => 3.460 ],
        80         => [ '1.00' => 0, '0.50' => 0.678, '0.40' => 0.846, '0.30' => 1.043, '0.20' => 1.292, '0.10' => 1.664, '0.05' => 1.990, '0.02' => 2.374, '0.01' => 2.639, '0.005' => 2.887, '0.002' => 3.195, '0.001' => 3.416 ],
        100        => [ '1.00' => 0, '0.50' => 0.677, '0.40' => 0.845, '0.30' => 1.042, '0.20' => 1.290, '0.10' => 1.660, '0.05' => 1.984, '0.02' => 2.364, '0.01' => 2.626, '0.005' => 2.871, '0.002' => 3.174, '0.001' => 3.390 ],
        120        => [ '1.00' => 0, '0.50' => 0.677, '0.40' => 0.845, '0.30' => 1.041, '0.20' => 1.289, '0.10' => 1.658, '0.05' => 1.980, '0.02' => 2.358, '0.01' => 2.617, '0.005' => 2.860, '0.002' => 3.160, '0.001' => 3.373 ],
        'infinity' => [ '1.00' => 0, '0.50' => 0.674, '0.40' => 0.842, '0.30' => 1.036, '0.20' => 1.282, '0.10' => 1.645, '0.05' => 1.960, '0.02' => 2.326, '0.01' => 2.576, '0.005' => 2.807, '0.002' => 3.090, '0.001' => 3.291 ],
    ];

    /**
     * Get one-sided t value using confidence level percentage
     *
     * @param string $ν degrees of freedom
     * @param string $cl confidence level percentage
     *
     * @return float t value
     *
     * @throws Exception\BadDataException
     */
    public static function getOneSidedTValueFromConfidenceLevel(string $ν, string $cl): float
    {
        if (!isset(self::ONE_SIDED_CONFIDENCE_LEVEL[$ν])) {
            throw new Exception\BadDataException("Degrees of freedom $ν is not in the t table.");
        }
        if (!isset(self::ONE_SIDED_CONFIDENCE_LEVEL[$ν][$cl])) {
            throw new Exception\BadDataException("Confidence level percentage $cl is not in the t table.");
        }
        return self::ONE_SIDED_CONFIDENCE_LEVEL[$ν][$cl];
    }

    /**
     * Get two-sided t value using confidence level percentage
     *
     * @param string $ν degrees of freedom
     * @param string $cl confidence level percentage
     *
     * @return float t value
     *
     * @throws Exception\BadDataException
     */
    public static function getTwoSidedTValueFromConfidenceLevel(string $ν, string $cl): float
    {
        if (!isset(self::TWO_SIDED_CONFIDENCE_LEVEL[$ν])) {
            throw new Exception\BadDataException("Degrees of freedom $ν is not in the t table.");
        }
        if (!isset(self::TWO_SIDED_CONFIDENCE_LEVEL[$ν][$cl])) {
            throw new Exception\BadDataException("Confidence level percentage $cl is not in the t table.");
        }
        return self::TWO_SIDED_CONFIDENCE_LEVEL[$ν][$cl];
    }

    /**
     * Get one-sided t value using alpha
     *
     * @param string $ν degrees of freedom
     * @param string $α alpha
     *
     * @return float t value
     *
     * @throws Exception\BadDataException
     */
    public static function getOneSidedTValueFromAlpha(string $ν, string $α): float
    {
        if (!isset(self::ONE_SIDED_ALPHA[$ν])) {
            throw new Exception\BadDataException("Degrees of freedom $ν is not in the t table.");
        }
        if (!isset(self::ONE_SIDED_ALPHA[$ν][$α])) {
            throw new Exception\BadDataException("Alpha $α is not in the t table.");
        }
        return self::ONE_SIDED_ALPHA[$ν][$α];
    }

    /**
     * Get two-sided t value using alpha
     *
     * @param string $ν degrees of freedom
     * @param string $α alpha
     *
     * @return float t value
     *
     * @throws Exception\BadDataException
     */
    public static function getTwoSidedTValueFromAlpha(string $ν, string $α): float
    {
        if (!isset(self::TWO_SIDED_ALPHA[$ν])) {
            throw new Exception\BadDataException("Degrees of freedom $ν is not in the t table.");
        }
        if (!isset(self::TWO_SIDED_ALPHA[$ν][$α])) {
            throw new Exception\BadDataException("Alpha $α is not in the t table.");
        }
        return self::TWO_SIDED_ALPHA[$ν][$α];
    }
}
