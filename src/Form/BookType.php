<?php

namespace App\Form;

use App\Client\QClient;
use App\Model\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    private QClient $client;

    public function __construct(QClient $client)
    {
        $this->client = $client;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('authorId', ChoiceType::class, [
                'choices' => $this->getAuthorSelection(),
                'label' => 'Author'
            ])
            ->add('title', TextType::class)
            ->add('releaseDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('description', TextType::class)
            ->add('isbn', TextType::class)
            ->add('format', TextType::class)
            ->add('numberOfPages', IntegerType::class)
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }

    private function getAuthorSelection(): array
    {
        $authors = $this->client->getAuthors();

        foreach ($authors as $author) {
            $selection[$author->getFullName()] = $author->getId();
        }

        return $selection ?? [];
    }
}
