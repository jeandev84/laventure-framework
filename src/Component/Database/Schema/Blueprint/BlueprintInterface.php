<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;


use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * BlueprintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
 */
interface BlueprintInterface
{



    /**
     * Add incremental column
     *
     * @param string $name
     * @return mixed
    */
    public function increments(string $name): mixed;








    /**
     * Add big increment
     *
     * @param string $name
     * @return mixed
    */
    public function bigIncrements(string $name): mixed;







    /**
     * Add integer
     *
     * @param string $name
     * @param int $length
     * @return mixed
    */
    public function integer(string $name, int $length = 11): mixed;







    /**
     * Add column type small integer
     *
     * @param string $name
     * @return mixed
    */
    public function smallInteger(string $name): mixed;







    /**
     * Add column type big integer
     *
     * @param string $name
     *
     * @return mixed
     */
    public function bigInteger(string $name): mixed;







    /**
     * Add column type big integer
     *
     * @param string $name
     *
     * @return mixed
     */
    public function mediumInteger(string $name): mixed;







    /**
     * Add column type tiny integer
     *
     * @param string $name
     *
     * @return mixed
     */
    public function tinyInteger(string $name): mixed;








    /**
     * Add column type string
     *
     * @param string $name
     * @param int $length
     * @return mixed
     */
    public function string(string $name, int $length = 255): mixed;






    /**
     * Add column type char
     *
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function char(string $name, $value): mixed;






    /**
     * Add column type boolean
     *
     * @param string $name
     *
     * @return mixed
     */
    public function boolean(string $name): mixed;







    /**
     * Add column type datetime
     *
     * @param string $name
     *
     * @return mixed
     */
    public function datetime(string $name): mixed;









    /**
     * Add column type time
     *
     * @param string $name
     *
     * @return mixed
     */
    public function time(string $name): mixed;







    /**
     * Add column type timestamp
     *
     * @param string $name
     *
     * @return mixed
     */
    public function timestamp(string $name): mixed;







    /**
     * Add column type binary
     *
     * @param string $name
     *
     * @return mixed
    */
    public function binary(string $name): mixed;







    /**
     * Add column type date
     *
     * @param string $name
     *
     * @return mixed
    */
    public function date(string $name): static;








    /**
     * Add column type decimal
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return mixed
     */
    public function decimal(string $name, int $precision, int $scale): mixed;









    /**
     * Add column type double
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return mixed
     */
    public function double(string $name, int $precision, int $scale): mixed;










    /**
     * Add column type enum
     *
     * @param string $name
     * @param array $values
     * @return mixed
     */
    public function enum(string $name, array $values): mixed;










    /**
     * Add column type float
     *
     * @param string $name
     * @return mixed
     */
    public function float(string $name): mixed;







    /**
     * Add column type json
     *
     * @param string $name
     * @return mixed
    */
    public function json(string $name): mixed;








    /**
     * Add column type text
     *
     * @param string $name
     *
     * @return mixed
     */
    public function text(string $name): mixed;








    /**
     * Add column type long text
     *
     * @param string $name
     *
     * @return mixed
    */
    public function longText(string $name): mixed;







    /**
     * Add column type medium text
     *
     * @param string $name
     *
     * @return mixed
    */
    public function mediumText(string $name): mixed;






    /**
     * Add column type tiny text
     *
     * @param string $name
     *
     * @return mixed
     */
    public function tinyText(string $name): mixed;








    /**
     * Add column type morphs
     *
     * @param string $name
     *
     * @return mixed
    */
    public function morphs(string $name): mixed;

}