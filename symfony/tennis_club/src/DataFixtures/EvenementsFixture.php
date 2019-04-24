<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evenement;

class EvenementsFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $evenement = new Evenement ();
        // $evenement  ->setTitreEvenements("Lorem Ipsum")
        //             ->setDetailsEvenements("<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla laoreet feugiat massa, non viverra ligula cursus a. Nunc tristique consectetur enim nec condimentum. Nunc vel lacus ut urna vestibulum efficitur quis id nulla. Fusce fermentum purus diam, gravida congue lectus pulvinar eget. Cras metus ante, ultrices eu iaculis sed, pellentesque sed quam. Vestibulum ac enim vulputate, fringilla odio sed, porttitor velit. Nullam ac ex risus. Quisque a malesuada urna. Ut nec mattis libero. Morbi accumsan aliquet sem, sed interdum sem condimentum at. Ut elit ligula, dictum vitae tellus a, volutpat vulputate metus. In ac augue convallis lorem porta faucibus.

        //             Phasellus eget gravida enim, sed mattis felis. Fusce tempor tellus sed elit vulputate, euismod eleifend nisi dignissim. Cras egestas tortor diam, et volutpat tortor commodo sed. Integer a odio imperdiet, pharetra arcu at, eleifend nibh. Vivamus malesuada, sapien vel sollicitudin accumsan, urna ante congue justo, et suscipit urna nibh et diam. Ut pharetra velit dolor, et ultrices lectus aliquet id. Curabitur faucibus pharetra metus, in commodo purus facilisis sed. Integer tempor dignissim urna luctus euismod. Sed non auctor enim. Nam eu dui vulputate, placerat lectus ac, finibus risus. Maecenas pellentesque aliquam leo, ut viverra neque hendrerit at.
                    
        //             Morbi elit neque, tincidunt sit amet luctus ut, interdum in purus. Donec elementum vulputate elementum. Donec augue mauris, luctus vitae metus mattis, scelerisque pharetra orci. Sed porta sapien sed tellus finibus, a feugiat purus efficitur. Vivamus quis ipsum in libero posuere interdum. Praesent non orci euismod augue commodo volutpat. Donec tempor, sem id consectetur vulputate, nisi risus porttitor augue, vitae commodo justo leo sed sapien. Suspendisse libero eros, tincidunt sit amet turpis vel, egestas convallis est. Morbi sit amet tempor quam, et feugiat dui.
                    
        //             Vivamus porttitor quis diam ut rutrum. Quisque sapien risus, feugiat vel enim sit amet, pharetra accumsan massa. Duis scelerisque enim lobortis est elementum, nec commodo arcu condimentum. Aenean eu facilisis elit. Fusce eget interdum odio, eu elementum mauris. Donec volutpat dolor sapien, sed rutrum leo consectetur a. In placerat dui sollicitudin mauris accumsan, id faucibus diam porta. Donec euismod dolor at sapien venenatis, vitae lacinia libero aliquet. Morbi quis lacus id massa rhoncus sodales. Fusce malesuada luctus ante, at pellentesque mi accumsan sed. Fusce feugiat nulla nulla, elementum elementum mauris vestibulum nec. Aliquam a metus vitae orci luctus congue eget sit amet metus. Nulla mollis sagittis fermentum. Praesent pulvinar ipsum a sapien bibendum, vitae pharetra quam venenatis. Aliquam id eros velit.
                    
        //             Curabitur egestas magna purus, et elementum ligula tempus ut. Proin quis porta purus. Nullam egestas lectus a tortor laoreet ultrices. Maecenas ligula nunc, mollis tempor bibendum in, dictum non massa. In id nunc lacinia, fringilla odio in, ultricies ligula. Aenean auctor vel arcu a commodo. Nullam vel bibendum sem. Praesent non elit sed nulla commodo ornare. Pellentesque nisi urna, vestibulum volutpat egestas eu, malesuada non felis. Etiam finibus fringilla sem, a porta lorem placerat id. In ultricies imperdiet neque, eu sagittis metus tristique et. Duis tristique turpis odio, nec consequat orci lobortis nec. Ut vel semper massa.</p>")
        //             ->setDateEvenements(new \DateTime());
        //             $manager->persist($evenement);

        // $manager->flush();
    }
}
