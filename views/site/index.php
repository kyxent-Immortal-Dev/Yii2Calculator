<?php
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Casio XD</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="calculadora-index">

        <div class="calculator" id="calculator">
            <div class="screen" id="screen">
                <div class="display">0</div>
            </div>
            <div class="buttons">
                <button class="btn-memory" data-action="mr">MRC</button>
                <button class="btn-memory" data-action="m-" disabled>M-</button>
                <button class="btn-memory" data-action="m+">M+</button>
                <button class="btn-function" data-action="sqrt">√</button>
                <button class="btn-function" data-action="percent">%</button>
                
                <button class="btn-arrow" data-action="backspace">←</button>
                <button class="btn-number" data-value="7">7</button>
                <button class="btn-number" data-value="8">8</button>
                <button class="btn-number" data-value="9">9</button>
                <button class="btn-function" data-action="divide">÷</button>
                
                <button class="btn-clear" data-action="ce">CE</button>
                <button class="btn-number" data-value="4">4</button>
                <button class="btn-number" data-value="5">5</button>
                <button class="btn-number" data-value="6">6</button>
                <button class="btn-function" data-action="multiply">×</button>
                
                <button class="btn-clear" data-action="ac">AC</button>
                <button class="btn-number" data-value="1">1</button>
                <button class="btn-number" data-value="2">2</button>
                <button class="btn-number" data-value="3">3</button>
                <button class="btn-function" data-action="subtract">−</button>
                
                <button class="btn-number" data-value="0">0</button>
                <button class="btn-number" data-value="00">00</button>
                <button class="btn-number" data-value=".">.</button>
                <button class="btn-function" data-action="equals">=</button>
                <button class="btn-function" data-action="add">+</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const screen = document.querySelector('.display');
            let current = '0';
            let previous = null;
            let operation = null;

            function updateScreen() {
                screen.textContent = current;
            }

            function clear() {
                current = '0';
                previous = null;
                operation = null;
                updateScreen();
            }

            function backspace() {
                if (current.length > 1) {
                    current = current.slice(0, -1);
                } else {
                    current = '0';
                }
                updateScreen();
            }

            function addDigit(digit) {
                if (current === '0' && digit !== '.') {
                    current = digit;
                } else if (digit === '.' && current.includes('.')) {
                    return; 
                    current += digit;
                }
                updateScreen();
            }

            function setOperation(op) {
                if (previous === null) {
                    previous = parseFloat(current);
                } else if (operation) {
                    calculate();
                }
                operation = op;
                current = '0';
            }

            function calculate() {
                if (previous !== null && operation) {
                    const prev = parseFloat(previous);
                    const curr = parseFloat(current);
                    switch (operation) {
                        case 'add':
                            current = (prev + curr).toString();
                            break;
                        case 'subtract':
                            current = (prev - curr).toString();
                            break;
                        case 'multiply':
                            current = (prev * curr).toString();
                            break;
                        case 'divide':
                            if (curr === 0) {
                                current = 'Error: División por cero';
                                return;
                            }
                            current = (prev / curr).toString();
                            break;
                    }
                    previous = null;
                    operation = null;
                    updateScreen();
                }
            }

            document.querySelectorAll('.buttons button').forEach(button => {
                button.addEventListener('click', () => {
                    const action = button.dataset.action;
                    const value = button.dataset.value;

                    if (action === 'ac') {
                        clear();
                    } else if (action === 'ce') {
                        current = '0';
                        updateScreen();
                    } else if (action === 'backspace') {
                        backspace();
                    } else if (action === 'add') {
                        setOperation('add');
                    } else if (action === 'subtract') {
                        setOperation('subtract');
                    } else if (action === 'multiply') {
                        setOperation('multiply');
                    } else if (action === 'divide') {
                        setOperation('divide');
                    } else if (action === 'equals') {
                        calculate();
                    } else if (value) {
                        addDigit(value);
                    }
                });
            });
        });
    </script>
</body>
</html>