<?php

namespace Progrupa\PollBundle\Formatter;

use Progrupa\PollBundle\Interfaces\PollElementResultFormatter;
use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Model\YesNoAnswer;
use Progrupa\PollBundle\Model\YesNoQuestion;
use Progrupa\PollBundle\Service\PollElementResult;
use Symfony\Component\Translation\TranslatorInterface;

class YesNoFormatter implements PollElementResultFormatter
{
    /** @var TranslatorInterface */
    private $translator;

    /**
     * YesNoFormatter constructor.
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function format(PollElementResult $elementResult)
    {
        $results = $elementResult->getResults();

        return [
            'type'  => self::TYPE_SINGLE,
            'answers'   =>  [
                $this->translator->trans('app.form.no') => array_key_exists(0, $results) ? $results[0] : 0,
                $this->translator->trans('app.form.yes') => array_key_exists(1, $results) ? $results[1] : 0,
            ]
        ];
    }

    /**
     * @param PollAnswer $answer
     * @return string
     */
    public function formatAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof YesNoAnswer) {
            throw new \InvalidArgumentException('Cannot format answers that is not a YesNoAnswer');
        }

        if (is_null($answer->getYesNo())) {
            return null;
        } else {
            return $answer->getYesNo() ? $this->translator->trans('app.form.yes') : $this->translator->trans('app.form.no');
        }
    }

    public function supportedQuestions()
    {
        return [
            YesNoQuestion::class,
        ];
    }

}
