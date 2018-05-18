<?php
namespace LearnHub\MainApp\MainAppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use LearnHub\MainApp\MainAppBundle\Entity\Category;

class FieldsOfScienceData extends AbstractFixture implements OrderedFixtureInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $prefix = 'category.';

        $initialFields = [
            'Acoustics' => new Category($prefix.strtolower('Acoustics')),
            'Aeronautics' => new Category($prefix.strtolower('Aeronautics')),
            'Agronomy' => new Category($prefix.strtolower('Agronomy')),
            'Anatomy' => new Category($prefix.strtolower('Anatomy')),
            'Anthropology' => new Category($prefix.strtolower('Anthropology')),
            'Archaeology' => new Category($prefix.strtolower('Archaeology')),
            'Astronomy' => new Category($prefix.strtolower('Astronomy')),
            'Astrophysics' => new Category($prefix.strtolower('Astrophysics')),
            'Bacteriology' => new Category($prefix.strtolower('Bacteriology')),
            'Biochemistry' => new Category($prefix.strtolower('Biochemistry')),
            'Biology' => new Category($prefix.strtolower('Biology')),
            'Botany' => new Category($prefix.strtolower('Botany')),
            'Cardiology' => new Category($prefix.strtolower('Cardiology')),
            'Cartography' => new Category($prefix.strtolower('Cartography')),
            'Chemistry' => new Category($prefix.strtolower('Chemistry')),
            'Cosmology' => new Category($prefix.strtolower('Cosmology')),
            'Crystallography' => new Category($prefix.strtolower('Crystallography')),
            'Ecology' => new Category($prefix.strtolower('Ecology')),
            'Embryology' => new Category($prefix.strtolower('Embryology')),
            'Endocrinology' => new Category($prefix.strtolower('Endocrinology')),
            'Entomology' => new Category($prefix.strtolower('Entomology')),
            'Enzymology' => new Category($prefix.strtolower('Enzymology')),
            'Forestry' => new Category($prefix.strtolower('Forestry')),
            'Gelotology' => new Category($prefix.strtolower('Gelotology')),
            'Genetics' => new Category($prefix.strtolower('Genetics')),
            'Geochemistry' => new Category($prefix.strtolower('Geochemistry')),
            'Geodesy' => new Category($prefix.strtolower('Geodesy')),
            'Geography' => new Category($prefix.strtolower('Geography')),
            'Geology' => new Category($prefix.strtolower('Geology')),
            'Geophysics' => new Category($prefix.strtolower('Geophysics')),
            'Hematology' => new Category($prefix.strtolower('Hematology')),
            'Histology' => new Category($prefix.strtolower('Histology')),
            'Horology' => new Category($prefix.strtolower('Horology')),
            'Hydrology' => new Category($prefix.strtolower('Hydrology')),
            'Ichthyology' => new Category($prefix.strtolower('Ichthyology')),
            'Immunology' => new Category($prefix.strtolower('Immunology')),
            'Linguistics' => new Category($prefix.strtolower('Linguistics')),
            'Mechanics' => new Category($prefix.strtolower('Mechanics')),
            'Medicine' => new Category($prefix.strtolower('Medicine')),
            'Meteorology' => new Category($prefix.strtolower('Meteorology')),
            'Metrology' => new Category($prefix.strtolower('Metrology')),
            'Microbiology' => new Category($prefix.strtolower('Microbiology')),
            'Mineralogy' => new Category($prefix.strtolower('Mineralogy')),
            'Mycology' => new Category($prefix.strtolower('Mycology')),
            'Neurology' => new Category($prefix.strtolower('Neurology')),
            'Nucleonics' => new Category($prefix.strtolower('Nucleonics')),
            'Nutrition' => new Category($prefix.strtolower('Nutrition')),
            'Oceanography' => new Category($prefix.strtolower('Oceanography')),
            'Oncology' => new Category($prefix.strtolower('Oncology')),
            'Optics' => new Category($prefix.strtolower('Optics')),
            'Paleontology' => new Category($prefix.strtolower('Paleontology')),
            'Pathology' => new Category($prefix.strtolower('Pathology')),
            'Petrology' => new Category($prefix.strtolower('Petrology')),
            'Pharmacology' => new Category($prefix.strtolower('Pharmacology')),
            'Physics' => new Category($prefix.strtolower('Physics')),
            'Physiology' => new Category($prefix.strtolower('Physiology')),
            'Psychology' => new Category($prefix.strtolower('Psychology')),
            'Radiology' => new Category($prefix.strtolower('Radiology')),
            'Robotics' => new Category($prefix.strtolower('Robotics')),
            'Seismology' => new Category($prefix.strtolower('Seismology')),
            'Spectroscopy' => new Category($prefix.strtolower('Spectroscopy')),
            'Systematics' => new Category($prefix.strtolower('Systematics')),
            'Thermodynamics' => new Category($prefix.strtolower('Thermodynamics')),
            'Toxicology' => new Category($prefix.strtolower('Toxicology')),
            'Virology' => new Category($prefix.strtolower('Virology')),
            'Volcanology' => new Category($prefix.strtolower('Volcanology')),
            'Zoology' => new Category($prefix.strtolower('Zoology'))
        ];

        $childrenFields = [
            'Quantummechanics' => new Category($prefix.strtolower('Quantum Mechanics'))
        ];

        $childrenFields['Quantummechanics']->setParent($initialFields['Physics']);

        foreach ($initialFields as $field) {
            $this->addReference('category-'.str_replace($prefix,'',$field->getI18nTitle()),$field);
            $manager->persist($field);
        }

        foreach ($childrenFields as $field) {
            $manager->persist($field);
        }

        $manager->flush();
    }


    public function getOrder() {
        return 1;
    }
}


