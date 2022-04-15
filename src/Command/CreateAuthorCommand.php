<?php

namespace App\Command;

use App\Client\QClient;
use App\Model\Author;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'create:author',
    description: 'Command for creating new author',
)]
class CreateAuthorCommand extends Command
{

    private QClient $QClient;

    public function __construct(QClient $QClient)
    {
        parent::__construct();

        $this->QClient = $QClient;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $author = new Author();
        $firstNameQuestion = (new Question('Insert first name: '))
            ->setValidator(function($answer) {
                if (!$answer) {
                    throw new \RuntimeException(
                        'First name cannot be empty'
                    );
                }

                return $answer;
            })
            ->setMaxAttempts(2)
        ;
        $author->setFirstName($helper->ask($input, $output, $firstNameQuestion));

        $lastNameQuestion = (new Question('Insert last name: '))
            ->setValidator(function($answer) {
                if (!$answer) {
                    throw new \RuntimeException(
                        'Last name cannot be empty'
                    );
                }

                return $answer;
            })
            ->setMaxAttempts(2)
        ;
        $author->setLastName($helper->ask($input, $output, $lastNameQuestion));

        $birthdayQuestion = (new Question('Insert birthday (format: 31-12-2000): '))
            ->setValidator(function($answer) {
                if (!$answer) {
                    throw new \RuntimeException(
                        'Date cannot be empty.'
                    );
                }

                try {
                    return new \DateTime($answer);
                } catch (\Throwable $e) {
                    throw new \RuntimeException('Wrong date format!');
                }
            })
            ->setMaxAttempts(2)
        ;
        $author->setBirthday($helper->ask($input, $output, $birthdayQuestion));

        $biographyQuestion = new Question('Insert biography: ');
        $author->setBiography($helper->ask($input, $output, $biographyQuestion));

        $genderQuestion = (new ChoiceQuestion('Insert gender: ', ['male', 'female']));
        $author->setGender($helper->ask($input, $output, $genderQuestion));

        $placeOfBirthQuestion = (new Question('Insert place of birth: '))
            ->setValidator(function($answer) {
                if (!$answer) {
                    throw new \RuntimeException(
                        'Place of birth cannot be empty.'
                    );
                }

                return $answer;
            })
            ->setMaxAttempts(2)
        ;
        $author->setPlaceOfBirth($helper->ask($input, $output, $placeOfBirthQuestion));

        //$this->QClient->insertAuthor($author);

        return Command::SUCCESS;
    }
}
