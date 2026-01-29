<?php

use Domain\ZipCode;

test('cria um cep válido com hífen', function () {
    $value = '06331-150';
    $zipCode = new ZipCode($value);

    expect($zipCode)
        ->toBeInstanceOf(ZipCode::class)
        ->and($zipCode->value)
        ->toBe('06331-150')
        ->and($zipCode->getRaw())
        ->toBe('06331150');
});

test('cria um cep válido sem hífen', function () {
    $value = '06331150';
    $zipCode = new ZipCode($value);

    expect($zipCode->value)
        ->toBe('06331-150')
        ->and($zipCode->getRaw())
        ->toBe('06331150');
});

test('lança exceção para CEP com menos de 8 dígitos', function () {
    new ZipCode('1234567');  // 7 dígitos
})->throws(InvalidArgumentException::class, 'CEP inválido');

test('lança exceção para CEP com mais de 8 dígitos', function () {
    new ZipCode('123456789');  // 9 dígitos
})->throws(InvalidArgumentException::class, 'CEP inválido');

test('lança exceção para CEP com caracteres não numéricos', function () {
    new ZipCode('12a45-678');
})->throws(InvalidArgumentException::class, 'CEP inválido');

test('lança exceção para CEP com formato incorreto', function () {
    new ZipCode('1234-567');  // 7 dígitos com hífen
})->throws(InvalidArgumentException::class, 'CEP inválido');

test('normaliza automaticamente CEP sem hífen', function () {
    $zipCode = new ZipCode('12345678');
    expect($zipCode->value)->toBe('12345-678');
});

test('normaliza automaticamente CEP com hífen', function () {
    $zipCode = new ZipCode('12345-678');
    expect($zipCode->value)->toBe('12345-678');
});

test('getRaw retorna somente dígitos', function () {
    $zipCode = new ZipCode('98765-432');
    expect($zipCode->getRaw())->toBe('98765432');
});

test('aceita CEPs aleatórios válidos', function () {
    foreach (['01001-000', '30140-110', '40010-000', '70040-010'] as $cep) {
        $zipCode = new ZipCode($cep);
        expect($zipCode->value)->toMatch('/^\d{5}-\d{3}$/');
        expect($zipCode->getRaw())->toMatch('/^\d{8}$/');
    }
});
