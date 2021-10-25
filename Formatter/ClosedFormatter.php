<?php

namespace Progrupa\PollBundle\Formatter;

use Progrupa\PollBundle\Entity\ClosedAnswerOption;
use Progrupa\PollBundle\Interfaces\PollElementResultFormatter;
use Progrupa\PollBundle\Entity\ClosedAnswer;
use Progrupa\PollBundle\Entity\ClosedQuestion;
use Progrupa\PollBundle\Entity\Poll;
use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Entity\PollOption;

use Progrupa\PollBundle\Repository\PollOptionRepository;
use Progrupa\PollBundle\Service\PollElementResult;
use Symfony\Component\Translation\TranslatorInterface;

class ClosedFormatter implements PollElementResultFormatter
{
    /** @var PollOptionRepository */
    private $pollOptionRepo;
    /** @var TranslatorInterface */
    private $translator;

    /** @var PollOption[] */
    private $options = [];
    /** @var array */
    private $pollsLoaded = [];

    /**
     * ClosedFormatter constructor.
     * @param PollOptionRepository $pollOptionRepo
     * @param TranslatorInterface $translator
     */
    public function __construct(PollOptionRepository $pollOptionRepo, TranslatorInterface $translator)
    {
        $this->pollOptionRepo = $pollOptionRepo;
        $this->translator = $translator;
    }

    /**
     * @param PollElementResult $elementResult
     * @return array
     */
    public function format(PollElementResult $elementResult)
    {
        $this->ensureOptions($elementResult->getQuestion()->getPoll());

        if (! $elementResult->getQuestion() instanceof ClosedQuestion) {
            throw new \InvalidArgumentException('Cannot format answers for a question that is not a ClosedQuestion');
        }

        $output = [
            'type'  =>  $elementResult->getQuestion()->getMultiple() ? self::TYPE_MULTIPLE : self::TYPE_SINGLE,
            'answers'   =>  []
        ];
        foreach ($elementResult->getResults() as $optionId => $count) {
            $option = $this->getOption($optionId);
            $label = $this->translator->trans($option->getLabel());
            $output['answers'][$label] = $count;
        }

        return $output;
    }

    /**
     * @param PollAnswer $answer
     * @return mixed
     */
    public function formatAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof ClosedAnswer) {
            throw new \InvalidArgumentException('Cannot format answers for a question that is not a BusinessProfileQuestion');
        }

        if ($answer->getQuestion()->getMultiple()) {
            $answers = [];

            /** @var ClosedAnswerOption $answerOption */
            foreach ($answer->getAnswerOptions() as $answerOption) {
                $option = $answerOption->getOption();

                $_answer = $this->translator->trans($answerOption->getOption()->getLabel());
                if ($option->isOpen()) {
                    $_answer .= ' ('.$answerOption->getOpenText().')';
                }

                $answers[] = $_answer;
            }

            return $answers;

        } else {
            /** @var ClosedAnswerOption $answerOption */
            $answerOption = $answer->getAnswerOptions()->first();

            if (!$answerOption) {
                return null;
            }

            $option = $answerOption->getOption();

            $_answer = $this->translator->trans($answerOption->getOption()->getLabel());
            if ($option->isOpen()) {
                $_answer .= ' ('.$answerOption->getOpenText().')';
            }

            return $_answer;
        }
    }

    /**
     * @return array|string[]
     */
    public function supportedQuestions()
    {
        return [ClosedQuestion::class];
    }

    private function ensureOptions(Poll $poll)
    {
        if (! array_key_exists($poll->getId(), $this->pollsLoaded)) {
            $allOptions = $this->pollOptionRepo->fetchPollOptions($poll);
            foreach ($allOptions as $option) {
                $this->options[$option->getId()] = $option;
            }

            $this->pollsLoaded[$poll->getId()] = true;
        }
    }

    private function getOption($optionId)
    {
        return $this->options[$optionId];
    }
}
