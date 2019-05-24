<?php

namespace Progrupa\PollBundle\Formatter;

use Progrupa\PollBundle\Interfaces\PollElementResultFormatter;
use Progrupa\PollBundle\Model\ClosedAnswer;
use Progrupa\PollBundle\Model\ClosedQuestion;
use Progrupa\PollBundle\Model\Poll;
use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Model\PollOption;

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
     * @return mixed|void
     */
    public function formatAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof ClosedAnswer) {
            throw new \InvalidArgumentException('Cannot format answers for a question that is not a BusinessProfileQuestion');
        }

        if ($answer->getQuestion()->getMultiple()) {
            $answers = [];
            foreach ($answer->getOptions() as $option) {
                $answers[] = $this->translator->trans($option->getLabel());
            }

            return $answers;

        } else {
            $option = $answer->getOptions()->first();
            return $option ? $this->translator->trans($option->getLabel()) : null;
        }
    }

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
