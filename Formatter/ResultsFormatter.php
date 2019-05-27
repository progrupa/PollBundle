<?php

namespace Progrupa\PollBundle\Formatter;

use Progrupa\PollBundle\Interfaces\PollElementResultFormatter;
use Progrupa\PollBundle\Entity\PollAnswer;
use Symfony\Component\Translation\TranslatorInterface;

class ResultsFormatter
{
    /** @var TranslatorInterface */
    private $translator;
    /** @var PollElementResultFormatter[] */
    private $formatters;

    /**
     * ResultsFormatter constructor.
     * @param TranslatorInterface $translator
     * @param PollElementResultFormatter[] $formatters
     */
    public function __construct(TranslatorInterface $translator, array $formatters)
    {
        $this->translator = $translator;
        /** @var PollElementResultFormatter $formatter */
        foreach ($formatters as $formatter) {
            foreach ($formatter->supportedQuestions() as $questionClass) {
                $this->formatters[$questionClass] = $formatter;
            }
        }
    }

    /**
     * @param PollResult $result
     */
    public function formattedAbsolute(PollResult $result)
    {
        $output = [];
        foreach ($result->getElementResults() as $elementResult) {
            $questionClass = get_class($elementResult->getQuestion());
            $output[] = array_merge(
                [
                    'name' => $this->translator->trans($elementResult->getQuestion()->getLabel()),
                    'total' =>  $elementResult->getTotalAnswers(),
                ],
                $this->formatters[$questionClass]->format($elementResult)
            );
        }

        return $output;
    }

    public function formattedPercent(PollResult $result)
    {
        $output = $this->formattedAbsolute($result);
        foreach ($output as $i => $formatted) {
            if ($formatted['type'] == PollElementResultFormatter::TYPE_LIST) {
                continue;
            }
            $total = $formatted['total'];

            foreach ($formatted['answers'] as $k => $count) {
                $output[$i]['answers'][$k] = 100 * ($count / $total);
            }
        }

        return $output;
    }

    /**
     * @param PollAnswer $answer
     * @return mixed
     */
    public function formattedAnswer(PollAnswer $answer)
    {
        $questionClass = get_class($answer->getQuestion());
        return $this->formatters[$questionClass]->formatAnswer($answer);
    }
}
