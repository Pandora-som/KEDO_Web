<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class IncomingLetterFilter extends AbstractFilter
{
    public const DOCUMENT_FROM_ID = 'document_from_id';
    public const DOCUMENT_NAME_ID = 'document_name_id';
    public const DOCUMENT_SUBJECT = 'document_subject';
    public const CLASSIFICATOR_ID = 'classificator_id';

    protected function getCallbacks(): array
    {
        return [
            self::DOCUMENT_FROM_ID => [$this, 'documentFromId'],
            self::DOCUMENT_NAME_ID => [$this, 'documentNameId'],
            self::DOCUMENT_SUBJECT => [$this, 'documentSubject'],
            self::CLASSIFICATOR_ID => [$this, 'classificatorId'],
        ];
    }

    public function documentFromId(Builder $builder, $value)
    {
        $builder->where('document_from_id', '=',$value);
    }

    public function documentNameId(Builder $builder, $value)
    {
        $builder->where('document_name_id', '=', $value);
    }

    public function documentSubject(Builder $builder, $value)
    {
        $builder->where('document_subject', 'like', "%{$value}%");
    }

    public function classificatorId(Builder $builder, $value)
    {
        $builder->where('classificator_id', '=', $value);
    }

}
