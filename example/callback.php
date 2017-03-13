<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

require __DIR__ . '/credentials.php';

/** @var \Tmconsulting\Uniteller\Client $uniteller */

if (! $uniteller->getSignature()->verify('signature_from_post_params', ['all_parameters_from_post'])) {
    return 'invalid_signature';
}

// ok!
