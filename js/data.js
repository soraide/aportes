const BASE_URL = `HTTP://192.168.110.10/aportes`;

const ESTADOS_CIVIL = [
    { idEstadoCivil: 1  , detalle: 'CASADO (A)'     },
    { idEstadoCivil: 2  , detalle: 'SOLTERO (A)'    },
    { idEstadoCivil: 3  , detalle: 'VIUDO (A)'      },
    { idEstadoCivil: 4  , detalle: 'DIVORCIADO (A)' },
];
const EXPEDIDOS = [
    { idExpedicion: 1, detalle: 'La Paz',        acronimo: 'LP' },
    { idExpedicion: 2, detalle: 'Oruro',         acronimo: 'OR' },
    { idExpedicion: 3, detalle: 'Potosí',        acronimo: 'PT' },
    { idExpedicion: 4, detalle: 'Cochabamba',    acronimo: 'CB' },
    { idExpedicion: 5, detalle: 'Santa Cruz',    acronimo: 'SC' },
    { idExpedicion: 6, detalle: 'Beni',          acronimo: 'BN' },
    { idExpedicion: 7, detalle: 'Pando',         acronimo: 'PA' },
    { idExpedicion: 8, detalle: 'Tarija',        acronimo: 'TJ' },
    { idExpedicion: 9, detalle: 'Chuquisaca',    acronimo: 'CH' },
];

const PARENTESCOS = [
    { idParentesco: 1, parentesco: 'Padre' },
    { idParentesco: 2, parentesco: 'Madre' },
    { idParentesco: 3, parentesco: 'Hijo' },
    { idParentesco: 4, parentesco: 'Hija' },
    { idParentesco: 5, parentesco: 'Hermano' },
    { idParentesco: 6, parentesco: 'Hermana' },
];

const GRADOS = [
    { idGrado: 1,   detalle: 'Almte.',          sigla: 'Almte.'         },
    { idGrado: 2,   detalle: 'V. Almte.',       sigla: 'V. Almte.'      },
    { idGrado: 3,   detalle: 'C. Almte.',       sigla: 'C. Almte.'      },
    { idGrado: 4,   detalle: 'CN.',             sigla: 'CN.'            },
    { idGrado: 5,   detalle: 'CF.',             sigla: 'CF.'            },
    { idGrado: 6,   detalle: 'CC.',             sigla: 'CC.'            },
    { idGrado: 7,   detalle: 'TN.',             sigla: 'TN.'            },
    { idGrado: 8,   detalle: 'TF.',             sigla: 'TF.'            },
    { idGrado: 9,   detalle: 'Alf.',            sigla: 'Alf.'           },
    { idGrado: 10,  detalle: 'Sof. Mtre.',      sigla: 'Sof. Mtre.'     },
    { idGrado: 11,  detalle: 'Sof. My.',        sigla: 'Sof. My.'       },
    { idGrado: 12,  detalle: 'Sof. 1ro.',       sigla: 'Sof. 1ro.'      },
    { idGrado: 13,  detalle: 'Sof. 2do.',       sigla: 'Sof. 2do.'      },
    { idGrado: 14,  detalle: 'Sof. Incl.',      sigla: 'Sof. Incl.'     },
    { idGrado: 15,  detalle: 'Sgto. 1ro.',      sigla: 'Sgto. 1ro.'     },
    { idGrado: 16,  detalle: 'Sgto. 2do.',      sigla: 'Sgto. 2do.'     },
    { idGrado: 17,  detalle: 'Sgto. Incl.',     sigla: 'Sgto. Incl.'    },
];