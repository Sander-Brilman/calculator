<?php
class calculator_datetime extends datatype
{
    public function __construct(string $datetime_string) {
        try {
            $this->datetime = new DateTime($this::str_to_full_date_string($datetime_string));
        } catch(Exception $ex) {
            throw new convert_error(3, [$datetime_string]);
        }
        parent::__construct('calculator_datetime', $datetime_string, false);
    }

    public DateTime $datetime;

    public static function str_to_full_date_string(string $input): string
    {
        try {
            return (new DateTime(str_replace(['/', '\\'], '-', $input)))->format('c');
        } catch(Exception $ex) {
            throw new convert_error(3, [$input]);
        }
    }

    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'full':
                return $this->datetime->format('H:i:s l j F Y');
                break;

            case 'date':
                return $this->datetime->format('d-m-Y');
                break;

            case 'time':
                return $this->datetime->format('H:i:s');
                break;

            case 'day':
                return $this->datetime->format('d');
                break;

            case 'month':
                return $this->datetime->format('m');
                break;
            
            case 'year':
                return $this->datetime->format('Y');
                break;

            case 'leapyear':
                return $this->datetime->format('Y') == '1' ? 'true' : 'false';
                break;
                
            case 'timezone':
                return $this->datetime->format('P');
                break;

            default:
                throw new convert_error(1, [$this->datatype_name, $datatype]);    
                break;
        }
    }

    public function add(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */

        if ($value->datatype_name == 's') {

            if ($value->value < 0) {
                $value->value = abs($value->value);
                return $this->subtract($value);
            }

            $copy = clone $this;
            $copy->datetime = $copy->datetime->add(new DateInterval('PT'.$value->value.'S'));
            $copy->value = $copy->convert_to('full');
            return $copy;
        }

        throw new datatype_error(1, [$value->datatype_name, '+', $this->datatype_name], [
            'nl' => 'Je kan alleen een tijdseenheid bij een datum/tijd optellen',
            'en' => 'You can only add a time unit to a date/time',
        ]);
    }

    public function subtract(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;
        if ($datatype_name == 's') {

            if ($value->value < 0) {
                $value->value = abs($value->value);
                return $this->add($value);
            }

            $copy = clone $this;
            $copy->datetime = $copy->datetime->sub(new DateInterval('PT'.$value->value.'S'));
            $copy->value = $copy->convert_to('full');
            return $copy;
        } else if ($value instanceof calculator_datetime) {
            return new second($this->datetime->getTimestamp() - $value->datetime->getTimestamp());
        }

        throw new datatype_error(1, [$value->datatype_name, '-', $this->datatype_name], [
            'nl' => 'Je kan alleen tijdseenheden & datums/tijden aftrekken van een datum/tijd',
            'en' => 'You can only subtract time units & dates/time from a date/time',
        ]);

    }


}


?>