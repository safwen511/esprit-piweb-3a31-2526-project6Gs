<?php

namespace App;

use App\DependencyInjection\Compiler\PruneDoctrineDoctorAnalyzersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        parent::build($container);

        if ('dev' === $this->getEnvironment()) {
            $container->addCompilerPass(new PruneDoctrineDoctorAnalyzersPass());
        }
    }
}
