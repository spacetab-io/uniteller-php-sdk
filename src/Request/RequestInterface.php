<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Request;

use Tmconsulting\Uniteller\Http\HttpManagerInterface;

/**
 * Interface RequestInterface
 *
 * @package Tmconsulting\Client
 */
interface RequestInterface
{
    /**
     * Изменение статуса регистрации карты
     */
    const REQUEST_CARD      = 'card';

    /**
     * Подтверждение платежа, проведённого с преавторизацией
     */
    const REQUEST_CONFIRM   = 'confirm';

    /**
     * Рекуррентные платежи
     */
    const REQUEST_RECURRENT = 'recurrent';

    /**
     * Отмена
     */
    const REQUEST_CANCEL    = 'unblock';

    /**
     * Запрос результата авторизации.
     */
    const REQUEST_RESULTS   = 'results';

    /**
     * Выполнение запроса к шлюзу.
     *
     * @param \Tmconsulting\Uniteller\Http\HttpManagerInterface $httpManager
     * @param array $parameters
     * @return mixed
     */
    public function execute(HttpManagerInterface $httpManager, array $parameters = []);
}