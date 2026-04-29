<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class PruneDoctrineDoctorAnalyzersPass implements CompilerPassInterface
{
    /**
     * These analyzers are useful in greenfield architecture work, but they are
     * overwhelmingly noisy for this project and drown out real request-time signals.
     *
     * Keeping them disabled in dev makes the profiler actionable again.
     *
     * @var list<class-string>
     */
    private const ANALYZERS_TO_REMOVE = [
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Performance\\DTOHydrationAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Performance\\OrderByWithoutLimitAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Performance\\QueryCachingOpportunityAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\BidirectionalConsistencyAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\BlameableTraitAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\EntityManagerInEntityAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\FloatForMoneyAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\ForeignKeyMappingAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\MissingEmbeddableOpportunityAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\NamingConventionAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\OnDeleteCascadeMismatchAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\PrimaryKeyStrategyAnalyzer',
        'AhmedBhs\\DoctrineDoctor\\Analyzer\\Integrity\\TimestampableTraitAnalyzer',
    ];

    public function process(ContainerBuilder $container): void
    {
        foreach (self::ANALYZERS_TO_REMOVE as $serviceId) {
            if ($container->hasDefinition($serviceId)) {
                $container->removeDefinition($serviceId);
            }
        }
    }
}
