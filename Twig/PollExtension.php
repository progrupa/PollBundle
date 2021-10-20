<?php

namespace Progrupa\PollBundle\Twig;

use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Formatter\ResultsFormatter;

class PollExtension extends \Twig_Extension
{
    /** @var ResultsFormatter */
    private $resultsFormatter;

    /**
     * PollExtension constructor.
     * @param ResultsFormatter $resultsFormatter
     */
    public function __construct(ResultsFormatter $resultsFormatter)
    {
        $this->resultsFormatter = $resultsFormatter;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('pollAnswer', [$this, 'formatAnswer'])
        ];
    }

    /**
     * @param PollAnswer $answer
     * @param string $separator
     * @return string
     */
    public function formatAnswer(PollAnswer $answer, $separator = ', ')
    {
        $formatted = $this->resultsFormatter->formattedAnswer($answer);
        if (is_array($formatted)) {
            $formatted = implode($separator, $formatted);
        }

        return $formatted;
    }
}
