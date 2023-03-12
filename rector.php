<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Assign\SplitListAssignToSeparateLineRector;
use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;
use Rector\CodeQuality\Rector\BooleanNot\ReplaceMultipleBooleanNotRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector;
use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\IntvalToTypeCastRector;
use Rector\CodeQuality\Rector\FuncCall\UnwrapSprintfOneArgumentRector;
use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector;
use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfExactValueReturnValueRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector;
use Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveDelegatingParentCallRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveLastReturnRector;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector;
use Rector\DeadCode\Rector\For_\RemoveDeadLoopRector;
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDuplicatedIfReturnRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\DeadCode\Rector\StmtsAwareInterface\RemoveJustPropertyFetchForAssignRector;
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector;
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector;
use Rector\Php70\Rector\Ternary\TernaryToSpaceshipRector;
use Rector\Php71\Rector\Assign\AssignArrayToStringRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php71\Rector\List_\ListToArrayDestructRector;
use Rector\Php72\Rector\Unset_\UnsetCastRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Php73\Rector\FuncCall\StringifyStrNeedlesRector;
use Rector\Php74\Rector\Assign\NullCoalescingOperatorRector;
use Rector\Php74\Rector\FuncCall\ArrayKeyExistsOnPropertyRector;
use Rector\Php74\Rector\FuncCall\MbStrrposEncodingArgumentPositionRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Php80\Rector\ClassMethod\AddParamBasedOnParentClassMethodRector;
use Rector\Php80\Rector\FuncCall\ClassOnObjectRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php80\Rector\Identical\StrStartsWithRector;
use Rector\Php80\Rector\NotIdentical\StrContainsRector;
use Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;
use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;
use Rector\Php81\Rector\ClassMethod\NewInInitializerRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->disableParallel();
    $rectorConfig->importNames();
    $rectorConfig->cacheDirectory('./storage/tmp/rector');
    $rectorConfig->sets([LevelSetList::UP_TO_PHP_81]);

    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/app/Http/Kernel.php',
        JsonThrowOnErrorRector::class,
        ChangeSwitchToMatchRector::class,
        UnionTypesRector::class,
        MixedTypeRector::class,
    ]);

    $rectorConfig->ruleWithConfiguration(TypedPropertyRector::class, [
        TypedPropertyRector::INLINE_PUBLIC => false,
    ]);

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
        ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        BooleanNotIdenticalToNotIdenticalRector::class,
        ChangeArrayPushToArrayAssignRector::class,
        CombineIfRector::class,
        ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        ForRepeatedCountToOwnVariableRector::class,
        ForeachToInArrayRector::class,
        IntvalToTypeCastRector::class,
        NewStaticToNewSelfRector::class,
        ReplaceMultipleBooleanNotRector::class,
        ReturnTypeFromStrictScalarReturnExprRector::class,
        ShortenElseIfRector::class,
        SimplifyConditionsRector::class,
        SimplifyEmptyArrayCheckRector::class,
        SimplifyForeachToCoalescingRector::class,
        SimplifyIfElseToTernaryRector::class,
        SimplifyIfExactValueReturnValueRector::class,
        SimplifyIfNotNullReturnRector::class,
        SimplifyIfReturnBoolRector::class,
        SimplifyTautologyTernaryRector::class,
        SimplifyUselessVariableRector::class,
        SplitListAssignToSeparateLineRector::class,
        StrlenZeroToIdenticalEmptyStringRector::class,
        UnnecessaryTernaryExpressionRector::class,
        UnwrapSprintfOneArgumentRector::class,
        UseIdenticalOverEqualWithSameTypeRector::class,
        AddArrayDefaultToArrayPropertyRector::class,
        BinarySwitchToIfElseRector::class,
        ConsistentImplodeRector::class,
        NewlineAfterStatementRector::class,
        SplitDoubleAssignRector::class,
        TernaryConditionVariableAssignmentRector::class,
        RecastingRemovalRector::class,
        RemoveAndTrueRector::class,
        RemoveConcatAutocastRector::class,
        RemoveDeadLoopRector::class,
        RemoveDeadTryCatchRector::class,
        RemoveDeadStmtRector::class,
        RemoveDelegatingParentCallRector::class,
        RemoveDuplicatedCaseInSwitchRector::class,
        RemoveDuplicatedIfReturnRector::class,
        RemoveEmptyClassMethodRector::class,
        RemoveJustPropertyFetchForAssignRector::class,
        RemoveLastReturnRector::class,
        RemoveUnusedForeachKeyRector::class,
        RemoveUselessVarTagRector::class,
        ChangeNestedForeachIfsToEarlyContinueRector::class,
        PreparedValueToEarlyReturnRector::class,
        RemoveAlwaysElseRector::class,
        ReturnEarlyIfVariableRector::class,
        TernaryToNullCoalescingRector::class,
        TernaryToSpaceshipRector::class,
        AssignArrayToStringRector::class,
        ListToArrayDestructRector::class,
        RemoveExtraParametersRector::class,
        UnsetCastRector::class,
        StringifyStrNeedlesRector::class,
        ArrayKeyExistsOnPropertyRector::class,
        MbStrrposEncodingArgumentPositionRector::class,
        NullCoalescingOperatorRector::class,
        RestoreDefaultNullToNullableTypePropertyRector::class,
        AddParamBasedOnParentClassMethodRector::class,
        ClassOnObjectRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        RemoveUnusedVariableInCatchRector::class,
        StrContainsRector::class,
        StrEndsWithRector::class,
        StrStartsWithRector::class,
        StringableForToStringRector::class,
        FinalizePublicClassConstantRector::class,
        FirstClassCallableRector::class,
        NewInInitializerRector::class,
    ]);
    // define sets of rules
    //    $rectorConfig->sets([
    //        LevelSetList::UP_TO_PHP_81
    //    ]);
};
