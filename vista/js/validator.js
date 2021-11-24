//DATOS DEL USUARIO
$(document).ready(function() {
    $('#datosUsuario').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usnombre: {
                message: 'Nombre no válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre es obligatorio'
                    },
                    regexp: {
                        regexp: /^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/,
                        message: 'Longitud mínima de 8 caracteres. Al menos una mayúscula. Al menos una minúscula. Al menos un número'
                    }
                }
            },
            uspass: {
                message: 'Contraseña no válida',
                validators: {
                    notEmpty: {
                        message: 'La contraseña es obligatoria'
                    },
                    regexp: {
                        regexp: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                        message: ' Longitud minima de 8 caracteres. Al menos una mayúscula o minúscula y un número.\n'
                    },
                    different: {
                        field: 'usnombre',
                        message: 'La contraseña y el nombre de usuario no pueden ser iguales'
                    }
                }
            },
            uspass2: {
                message: 'Contraseña no válida',
                validators: {
                    notEmpty: {
                        message: 'La contraseña es obligatoria'
                    },
                    regexp: {
                        regexp: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                        message: ' Longitud minima de 8 caracteres. Al menos una mayúscula o minúscula y un número.\n'
                    },
                    identical: {
                        field: 'uspass',
                        message: 'Las contraseñas deben ser iguales'
                    }
                }
            },
            usmail: {
                message: 'Mail no valido',
                validators: {
                    notEmpty: {
                        message: 'El mail es obligatorio'
                    },
                    regexp: {
                        regexp: /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,
                        message: 'Mail no válido'
                    }
                }
            }
        }
    });
});

//DATOS DEL PRODUCTO
$(document).ready(function() {
    $('#datosProducto').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            idproducto: {
                message: 'ID no válido',
                validators: {
                    notEmpty: {
                        message: 'El ID es obligatorio'
                    },
                    regexp: {
                        regexp: /^[A-Z][0-9]+/,
                        message: 'Identificador de tipo y número'
                    }
                }
            },
            pronombre: {
                message: 'Nombre no válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            prodetalle: {
                message: 'Detalle no válido',
                validators: {
                    notEmpty: {
                        message: 'El detalle es obligatorio'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]/,
                        message: 'Detalle no válido'
                    }
                }
            },
            proprecio: {
                message: 'Precio no válido',
                validators: {
                    notEmpty: {
                        message: 'El precio es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Precio no válido'
                    }
                }
            },
            prodescuento: {
                message: 'Descuento no válido',
                validators: {
                    notEmpty: {
                        message: 'El descuento es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Descuento no válido'
                    }
                }
            },
            procantstock: {
                message: 'Cantidad en stock no válida',
                validators: {
                    notEmpty: {
                        message: 'La cantidad en stock es obligatoria'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Cantidad en stock no válida'
                    }
                }
            }
        }
    });
});

//DATOS DEL MENU
$(document).ready(function() {
    $('#datosMenu').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            menombre: {
                message: 'Nombre no válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre es obligatorio'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]/,
                        message: 'Nombre no válido'
                    }
                }
            },
            medescripcion: {
                message: 'Descripcion no válida',
                validators: {
                    notEmpty: {
                        message: 'La descripción es obligatoria'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]/,
                        message: 'Descripción no válida'
                    }
                }
            }
        }
    });
});