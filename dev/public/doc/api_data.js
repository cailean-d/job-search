define({ "api": [
  {
    "type": "post",
    "url": "help_compskill",
    "title": "Добавить запись",
    "name": "AddCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Начальный уровень\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень владения компьютером</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Начальный уровень\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_compskill",
    "title": "Удалить все записи",
    "name": "DeleteAllCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_compskill/:id",
    "title": "Удалить запись",
    "name": "DeleteCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_compskill",
    "title": "Получить все записи",
    "name": "GetAllCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень владения компьютером</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Не владею\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"Начальный уровень\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Уверенный пользователь\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_compskill/:id",
    "title": "Получить запись",
    "name": "GetCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень владения компьютером</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Начальный уровень\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_compskill/:id",
    "title": "Обновить запись",
    "name": "UpdateCompSkill",
    "group": "Help_CompSkill",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Начальный уровень\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень владения компьютером</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Начальный уровень\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperCompSkillApi.php",
    "groupTitle": "Help_CompSkill",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_compskill/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "help_education",
    "title": "Добавить запись",
    "name": "AddEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Высшее\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень образвания</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Высшее\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_education",
    "title": "Удалить все записи",
    "name": "DeleteAllEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_education/:id",
    "title": "Удалить запись",
    "name": "DeleteEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_education",
    "title": "Получить все записи",
    "name": "GetAllEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень образвания</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Среднее\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"Среднее cпециальное\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Неоконченное высшее\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_education/:id",
    "title": "Получить запись",
    "name": "GetEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень образвания</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Среднее\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_education/:id",
    "title": "Обновить запись",
    "name": "UpdateEducation",
    "group": "Help_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Высшее\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень образвания</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Высшее\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperEducationApi.php",
    "groupTitle": "Help_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_education/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "help_industry",
    "title": "Добавить запись",
    "name": "AddIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Производство\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Производство\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_industry",
    "title": "Удалить все записи",
    "name": "DeleteAllIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_industry/:id",
    "title": "Удалить запись",
    "name": "DeleteIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_industry",
    "title": "Получить все записи",
    "name": "GetAllIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Производство\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"Продажи\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Юриспруденция\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_industry/:id",
    "title": "Получить запись",
    "name": "GetIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Производство\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_industry/:id",
    "title": "Обновить запись",
    "name": "UpdateIndustry",
    "group": "Help_Industry",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Производство\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Уровень образвания</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Производство\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperIndustryApi.php",
    "groupTitle": "Help_Industry",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_industry/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "help_language",
    "title": "Добавить запись",
    "name": "AddLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Английский\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Язык</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Английский\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_language",
    "title": "Удалить все записи",
    "name": "DeleteAllLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_language/:id",
    "title": "Удалить запись",
    "name": "DeleteLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_language",
    "title": "Получить все записи",
    "name": "GetAllLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Язык</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Английский\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"Французский\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Китайский\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_language/:id",
    "title": "Получить запись",
    "name": "GetLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Язык</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Английский\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_language/:id",
    "title": "Обновить запись",
    "name": "UpdateLanguage",
    "group": "Help_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Английский\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Язык</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Английский\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperLanguageApi.php",
    "groupTitle": "Help_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_language/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "help_schedule",
    "title": "Добавить запись",
    "name": "AddSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Полный день\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>График</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Полный день\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_schedule",
    "title": "Удалить все записи",
    "name": "DeleteAllSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_schedule/:id",
    "title": "Удалить запись",
    "name": "DeleteSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_schedule",
    "title": "Получить все записи",
    "name": "GetAllSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>График</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Полный день\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"Неполный день\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Сменный\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_schedule/:id",
    "title": "Получить запись",
    "name": "GetSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>График</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Полный день\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_schedule/:id",
    "title": "Обновить запись",
    "name": "UpdateSchedule",
    "group": "Help_Schedule",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Полный день\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>График</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Полный день\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperScheduleApi.php",
    "groupTitle": "Help_Schedule",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_schedule/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "help_workplace",
    "title": "Добавить запись",
    "name": "AddWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Работы на дому\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Место работы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Работы на дому\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_workplace",
    "title": "Удалить все записи",
    "name": "DeleteAllWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Все записи успешно удалены</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace"
      }
    ]
  },
  {
    "type": "delete",
    "url": "help_workplace/:id",
    "title": "Удалить запись",
    "name": "DeleteWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_workplace",
    "title": "Получить все записи",
    "name": "GetAllWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Место работы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"id\" : \"1\"\n        \"name\" : \"Работы на дому\"\n    },\n\n    {\n        \"id\" : \"2\"\n        \"name\" : \"На территории работодателя\"\n    },\n\n    {\n        \"id\" : \"3\"\n        \"name\" : \"Разъездная работа\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace"
      }
    ]
  },
  {
    "type": "get",
    "url": "help_workplace/:id",
    "title": "Получить запись",
    "name": "GetWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Место работы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Работы на дому\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "help_workplace/:id",
    "title": "Обновить запись",
    "name": "UpdateWorkPlace",
    "group": "Help_WorkPlace",
    "version": "1.0.0",
    "permission": [
      {
        "name": "admin",
        "title": "Авторизация под учетной записью администратора",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название новой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     name : Работы на дому\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Место работы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"name\" : \"Работы на дому\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Name",
            "description": "<p>Необходимо поле <code>name</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/HelperWorkPlaceApi.php",
    "groupTitle": "Help_WorkPlace",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/help_workplace/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "resume",
    "title": "Создать",
    "name": "AddResume",
    "group": "Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "work_place_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "comp_skill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "Parameter",
            "type": "Blob",
            "optional": true,
            "field": "avatar",
            "description": "<p>Файл</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry_id\" : \"5\",\n    \"schedule_id\" : \"3\",\n    \"salary\" : \"99999\",\n    \"workplace_id\" : \"2\",\n    \"compskill_id\" : \"1\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry_id\" : \"5\",\n    \"schedule_id\" : \"3\",\n    \"salary\" : \"99999\",\n    \"workplace_id\" : \"2\",\n    \"compskill_id\" : \"1\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordExists",
            "description": "<p>Запись уже существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Birthday",
            "description": "<p>Некорректное поле <code>birthday</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Phone",
            "description": "<p>Некорректное поле <code>phone</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Email",
            "description": "<p>Некорректное поле <code>email</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Post",
            "description": "<p>Некорректное поле <code>post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-IndustryId",
            "description": "<p>Некорректное поле <code>industry_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-ScheduleId",
            "description": "<p>Некорректное поле <code>schedule_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Salary",
            "description": "<p>Некорректное поле <code>salary</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-WorkplaceId",
            "description": "<p>Некорректное поле <code>work_place_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-CompskillId",
            "description": "<p>Некорректное поле <code>comp_skill_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Car",
            "description": "<p>Некорректное поле <code>car</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Courses",
            "description": "<p>Некорректное поле <code>courses</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Skills",
            "description": "<p>Некорректное поле <code>skills</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [edu_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume"
      }
    ]
  },
  {
    "type": "delete",
    "url": "resume",
    "title": "Удалить",
    "name": "DeleteResume",
    "group": "Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Запись успешно удалена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\" : \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетной записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume"
      }
    ]
  },
  {
    "type": "get",
    "url": "resume/full",
    "title": "Полное резюме",
    "name": "GetFullResume",
    "group": "Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>Отрасль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>Ссылка на аватар</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "education",
            "description": "<p>Образование</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>Опыт работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "language",
            "description": "<p>Владение языками</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"firstname\" : \"Петр\",\n    \"lastname\" : \"Петров\",\n    \"gender\" : \"Мужской\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry\" : \"Охрана, безопасность\",\n    \"schedule\" : \"Вахтовый\",\n    \"salary\" : \"99999\",\n    \"workplace\" : \"На территории работодателя\",\n    \"compskill\" : \"Уверенный пользователь\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n    \"avatar\" : \"public/images/avatar/avatar.jpg\",\n    \"education\": [\n         {\n             \"level\": \"Среднее\",\n             \"inst\": \"ТГУ\",\n             \"city\": \"Москва\",\n             \"faculty\": \"\",\n             \"period\": \"2011 - 2012\"\n         },\n         {\n             \"level\": \"Неоконченное высшее\",\n             \"inst\": \"МГУ\",\n             \"city\": \"Москва\",\n             \"faculty\": \"Физико-математический\",\n             \"period\": \"2005 - 2010\"\n         }\n     ],\n     \"experience\": [\n         {\n             \"post\": \"Охранник\",\n             \"company\": \"Моя компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Охрана, безопасность\",\n             \"period\": \"Июнь 2015 - Август 2015\",\n             \"functions\": \"Мои функции\"\n         },\n         {\n             \"post\": \"Сторож2\",\n             \"company\": \"Компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Финансы, бухгалтерия\",\n             \"period\": \"Сентябрь 2010 - Октябрь 2015\",\n             \"functions\": \"Мои функции\"\n         },\n         {\n             \"post\": \"Сторож2\",\n             \"company\": \"Компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Финансы, бухгалтерия\",\n             \"period\": \"Сентябрь 2010 - Октябрь 2015\",\n             \"functions\": \"Мои функции\"\n         }\n     ],\n     \"language\": [\n         {\n             \"language\": \"Украинский\",\n             \"lang_level\": \"Разговорный\"\n         }\n     ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume/full"
      }
    ]
  },
  {
    "type": "get",
    "url": "resume",
    "title": "Мое резюме",
    "name": "GetMyResume",
    "group": "Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>Ссылка на аватар</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"firstname\" : \"Петр\",\n    \"lastname\" : \"Петров\",\n    \"gender\" : \"Мужской\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry_id\" : \"5\",\n    \"schedule_id\" : \"3\",\n    \"salary\" : \"99999\",\n    \"workplace_id\" : \"2\",\n    \"compskill_id\" : \"1\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n    \"avatar\" : \"public/images/avatar/avatar.jpg\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетной записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume"
      }
    ]
  },
  {
    "type": "get",
    "url": "resume/:id",
    "title": "Получить запись",
    "name": "GetResume",
    "group": "Resume",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>Ссылка на аватар</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"firstname\" : \"Петр\",\n    \"lastname\" : \"Петров\",\n    \"gender\" : \"Мужской\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry_id\" : \"5\",\n    \"schedule_id\" : \"3\",\n    \"salary\" : \"99999\",\n    \"workplace_id\" : \"2\",\n    \"compskill_id\" : \"1\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n    \"avatar\" : \"public/images/avatar/avatar.jpg\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "resume/:id/full",
    "title": "Полная запись",
    "name": "MyFullResume",
    "group": "Resume",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>Отрасль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>Ссылка на аватар</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "education",
            "description": "<p>Образование</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>Опыт работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "language",
            "description": "<p>Владение языками</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"firstname\" : \"Петр\",\n    \"lastname\" : \"Петров\",\n    \"gender\" : \"Мужской\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry\" : \"Охрана, безопасность\",\n    \"schedule\" : \"Вахтовый\",\n    \"salary\" : \"99999\",\n    \"workplace\" : \"На территории работодателя\",\n    \"compskill\" : \"Уверенный пользователь\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n    \"avatar\" : \"public/images/avatar/avatar.jpg\",\n    \"education\": [\n         {\n             \"level\": \"Среднее\",\n             \"inst\": \"ТГУ\",\n             \"city\": \"Москва\",\n             \"faculty\": \"\",\n             \"period\": \"2011 - 2012\"\n         },\n         {\n             \"level\": \"Неоконченное высшее\",\n             \"inst\": \"МГУ\",\n             \"city\": \"Москва\",\n             \"faculty\": \"Физико-математический\",\n             \"period\": \"2005 - 2010\"\n         }\n     ],\n     \"experience\": [\n         {\n             \"post\": \"Охранник\",\n             \"company\": \"Моя компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Охрана, безопасность\",\n             \"period\": \"Июнь 2015 - Август 2015\",\n             \"functions\": \"Мои функции\"\n         },\n         {\n             \"post\": \"Сторож2\",\n             \"company\": \"Компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Финансы, бухгалтерия\",\n             \"period\": \"Сентябрь 2010 - Октябрь 2015\",\n             \"functions\": \"Мои функции\"\n         },\n         {\n             \"post\": \"Сторож2\",\n             \"company\": \"Компания\",\n             \"city\": \"Город\",\n             \"industry\": \"Финансы, бухгалтерия\",\n             \"period\": \"Сентябрь 2010 - Октябрь 2015\",\n             \"functions\": \"Мои функции\"\n         }\n     ],\n     \"language\": [\n         {\n             \"language\": \"Украинский\",\n             \"lang_level\": \"Разговорный\"\n         }\n     ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume/:id/full"
      }
    ]
  },
  {
    "type": "post",
    "url": "resume/update",
    "title": "Обновить",
    "name": "UpdateResume",
    "group": "Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "work_place_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "comp_skill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          },
          {
            "group": "Parameter",
            "type": "Blob",
            "optional": true,
            "field": "avatar",
            "description": "<p>Файл</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>Дата рождения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Желаемая должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_id",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Желаемый график работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Желаемая заплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "workplace_id",
            "description": "<p>Желаемое место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "compskill_id",
            "description": "<p>Владение компьютером</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "car",
            "description": "<p>Наличие авто</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "courses",
            "description": "<p>Пройденные курсы, тренинги</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "skills",
            "description": "<p>Навыки и умения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"user_id\" : \"5\",\n    \"birthday\" : \"01.01.1980\",\n    \"city\" : \"Москва\",\n    \"phone\" : \"+79999999999\",\n    \"email\" : \"test@test.com\",\n    \"post\" : \"Сторож\",\n    \"industry_id\" : \"5\",\n    \"schedule_id\" : \"3\",\n    \"salary\" : \"99999\",\n    \"workplace_id\" : \"2\",\n    \"compskill_id\" : \"1\",\n    \"car\" : \"Нет\",\n    \"courses\" : \"Мои курсы...\",\n    \"skills\" : \"Мои навыки...\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordDoesNotExist",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Birthday",
            "description": "<p>Некорректное поле <code>birthday</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Phone",
            "description": "<p>Некорректное поле <code>phone</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Email",
            "description": "<p>Некорректное поле <code>email</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Post",
            "description": "<p>Некорректное поле <code>post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-IndustryId",
            "description": "<p>Некорректное поле <code>industry_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-ScheduleId",
            "description": "<p>Некорректное поле <code>schedule_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Salary",
            "description": "<p>Некорректное поле <code>salary</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-WorkplaceId",
            "description": "<p>Некорректное поле <code>work_place_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-CompskillId",
            "description": "<p>Некорректное поле <code>comp_skill_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Car",
            "description": "<p>Некорректное поле <code>car</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Courses",
            "description": "<p>Некорректное поле <code>courses</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Skills",
            "description": "<p>Некорректное поле <code>skills</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [edu_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ResumeApi.php",
    "groupTitle": "Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/resume/update"
      }
    ]
  },
  {
    "type": "post",
    "url": "education",
    "title": "Добавить",
    "name": "AddEducation",
    "group": "Resume_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "edu_level",
            "description": "<p>ID Уровень образования</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "edu_inst",
            "description": "<p>Название учебного заведения</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "edu_city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "edu_fac",
            "description": "<p>Факультет</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "edu_period",
            "description": "<p>Период учебы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"edu_level\" : \"3\",\n     \"edu_inst\" : \"МГУ\",\n     \"edu_city\" : \"Москва\",\n     \"edu_fac\" : \"Физико-математический\",\n     \"edu_period\" : \"2005-2010\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>Уровень образования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "institute",
            "description": "<p>Название учебного заведения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "faculty",
            "description": "<p>Факультет</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период учебы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"level\" : \"Высшее\",\n    \"institute\" : \"МГУ\",\n    \"city\" : \"Москва\",\n    \"faculty\" : \"Физико-математический\",\n    \"period\" : \"2005-2010\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>edu_level</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid2",
            "description": "<p>Объект должен содержать поле <code>edu_inst</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid3",
            "description": "<p>Объект должен содержать поле <code>edu_city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid4",
            "description": "<p>Объект должен содержать поле <code>edu_period</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LevelId",
            "description": "<p>Некорректное поле <code>edu_level</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Institute",
            "description": "<p>Некорректное поле <code>edu_inst</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>edu_city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Period",
            "description": "<p>Некорректное поле <code>edu_period</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Faculty",
            "description": "<p>Некорректное поле <code>edu_fac</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [edu_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/EducationApi.php",
    "groupTitle": "Resume_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/education"
      }
    ]
  },
  {
    "type": "delete",
    "url": "education",
    "title": "Удалить несколько",
    "name": "DeleteArrayEducation",
    "group": "Resume_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Массив ID, которые надо удалить</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"data\" : \"1, 2, 3, 4, 5\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете удалить чужую запись</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Data",
            "description": "<p>Некорректный массив <code>data</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетноый записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/EducationApi.php",
    "groupTitle": "Resume_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/education"
      }
    ]
  },
  {
    "type": "delete",
    "url": "education/:id",
    "title": "Удалить",
    "name": "DeleteEducation",
    "group": "Resume_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете удалить чужую запись</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не можете удалить чужую запись\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/EducationApi.php",
    "groupTitle": "Resume_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/education/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "education",
    "title": "Получить все",
    "name": "GetEducation",
    "group": "Resume_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>Уровень образования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "institute",
            "description": "<p>Название учебного заведения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "faculty",
            "description": "<p>Факультет</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период учебы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n         \"id\" : \"1\",\n         \"level\" : \"Среднее\",\n         \"institute\" : \"ТГУ\",\n         \"city\" : \"Москва\",\n         \"faculty\" : \"\",\n         \"period\" : \"2002-2010\"\n     },\n     {\n         \"id\" : \"2\",\n         \"level\" : \"Высшее\",\n         \"institute\" : \"МГУ\",\n         \"city\" : \"Москва\",\n         \"faculty\" : \"Физико-математический\",\n         \"period\" : \"2010-2015\"\n     }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетной записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/EducationApi.php",
    "groupTitle": "Resume_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/education"
      }
    ]
  },
  {
    "type": "put",
    "url": "education",
    "title": "Обновить",
    "name": "UpdateEducation",
    "group": "Resume_Education",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "record_id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "edu_level",
            "description": "<p>ID Уровень образования</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "edu_inst",
            "description": "<p>Название учебного заведения</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "edu_city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "edu_fac",
            "description": "<p>Факультет</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "edu_period",
            "description": "<p>Период учебы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"record_id\" : \"5\",\n     \"edu_level\" : \"3\",\n     \"edu_fac\" : \"Физико-математический\",\n     \"edu_period\" : \"2005-2010\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>Уровень образования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "institute",
            "description": "<p>Название учебного заведения</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "faculty",
            "description": "<p>Факультет</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период учебы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\",\n    \"level\" : \"Высшее\",\n    \"institute\" : \"МГУ\",\n    \"city\" : \"Москва\",\n    \"faculty\" : \"Физико-математический\",\n    \"period\" : \"2005-2010\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете редактировать чужую запись</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>record_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LevelId",
            "description": "<p>Некорректное поле <code>edu_level</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Institute",
            "description": "<p>Некорректное поле <code>edu_inst</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>edu_city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Period",
            "description": "<p>Некорректное поле <code>edu_period</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Faculty",
            "description": "<p>Некорректное поле <code>edu_fac</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [edu_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/EducationApi.php",
    "groupTitle": "Resume_Education",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/education"
      }
    ]
  },
  {
    "type": "post",
    "url": "experience",
    "title": "Добавить",
    "name": "AddExperience",
    "group": "Resume_Experience",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp_post",
            "description": "<p>Должность</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp_company",
            "description": "<p>Компания</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp_city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp_industry",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "work_period",
            "description": "<p>Период работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp_func",
            "description": "<p>Обязанности и функции</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"exp_post\" : \"Сторож\",\n     \"exp_company\" : \"Компания\",\n     \"exp_city\" : \"Москва\",\n     \"exp_industry\" : \"14\",\n     \"work_period\" : \"Июнь 2016 - Август 2018\",\n     \"exp_func\" : \"Функции...\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Компания</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>Отрасль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "functions",
            "description": "<p>Обязанности и функции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"2\",\n    \"user_id\" : \"5\",\n    \"post\" : \"Сторож\",\n    \"company\" : \"Компания\",\n    \"city\" : \"Москва\",\n    \"industry\" : \"Охрана, безопасность\",\n    \"period\" : \"Июнь 2016 - Август 2018\",\n    \"functions\" : \"Функции...\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>exp_post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid2",
            "description": "<p>Объект должен содержать поле <code>exp_industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid3",
            "description": "<p>Объект должен содержать поле <code>work_period</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid4",
            "description": "<p>Объект должен содержать поле <code>exp_func</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LevelId",
            "description": "<p>Некорректное поле <code>exp_post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Institute",
            "description": "<p>Некорректное поле <code>exp_company</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>exp_city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Period",
            "description": "<p>Некорректное поле <code>exp_industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Faculty",
            "description": "<p>Некорректное поле <code>work_period</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [exp_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ExperienceApi.php",
    "groupTitle": "Resume_Experience",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/experience"
      }
    ]
  },
  {
    "type": "delete",
    "url": "experience",
    "title": "Удалить несколько",
    "name": "DeleteArrayExperience",
    "group": "Resume_Experience",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Массив ID, которые надо удалить</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"data\" : \"1, 2, 3, 4, 5\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете удалить чужую запись</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Data",
            "description": "<p>Некорректный массив <code>data</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетноый записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ExperienceApi.php",
    "groupTitle": "Resume_Experience",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/experience"
      }
    ]
  },
  {
    "type": "delete",
    "url": "experience/:id",
    "title": "Удалить",
    "name": "DeleteExperience",
    "group": "Resume_Experience",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете удалить чужую запись</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не можете удалить чужую запись\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ExperienceApi.php",
    "groupTitle": "Resume_Experience",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/experience/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "experience",
    "title": "Получить все",
    "name": "GetExperience",
    "group": "Resume_Experience",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Компания</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>Отрасль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "functions",
            "description": "<p>Обязанности и функции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n     {\n         \"id\" : \"2\",\n         \"user_id\" : \"5\",\n         \"post\" : \"Сторож\",\n         \"company\" : \"Компания\",\n         \"city\" : \"Москва\",\n         \"industry\" : \"Охрана, безопасность\",\n         \"period\" : \"Июнь 2016 - Август 2018\",\n         \"functions\" : \"Функции...\"\n     },\n     {\n         \"id\" : \"3\",\n         \"user_id\" : \"5\",\n         \"post\" : \"Бухгалер\",\n         \"company\" : \"Компания\",\n         \"city\" : \"Москва\",\n         \"industry\" : \"Финансы, бухгалтерия\",\n         \"period\" : \"Июнь 2015 - Июль 2016\",\n         \"functions\" : \"Функции...\"\n     }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетной записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ExperienceApi.php",
    "groupTitle": "Resume_Experience",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/experience"
      }
    ]
  },
  {
    "type": "put",
    "url": "experience",
    "title": "Обновить",
    "name": "UpdateExperience",
    "group": "Resume_Experience",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "record_id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp_post",
            "description": "<p>Должность</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp_company",
            "description": "<p>Компания</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp_city",
            "description": "<p>Город</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp_industry",
            "description": "<p>ID отрасли</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "work_period",
            "description": "<p>Период работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp_func",
            "description": "<p>Период учебы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"record_id\" : \"5\",\n     \"exp_post\" : \"Сторож\",\n     \"exp_industry\" : \"14\",\n     \"work_period\" : \"Сентябрь 2010 - Октябрь 2012\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "post",
            "description": "<p>Должность</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Компания</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>Город</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>Отрасль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "period",
            "description": "<p>Период работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "functions",
            "description": "<p>Обязанности и функции</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"2\",\n    \"user_id\" : \"5\",\n    \"post\" : \"Сторож\",\n    \"company\" : \"Компания\",\n    \"city\" : \"Москва\",\n    \"industry\" : \"Охрана, безопасность\",\n    \"period\" : \"Июнь 2016 - Август 2018\",\n    \"functions\" : \"Функции...\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете редактировать чужую запись</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>exp_post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid2",
            "description": "<p>Объект должен содержать поле <code>exp_industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid3",
            "description": "<p>Объект должен содержать поле <code>work_period</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid4",
            "description": "<p>Объект должен содержать поле <code>exp_func</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LevelId",
            "description": "<p>Некорректное поле <code>exp_post</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Institute",
            "description": "<p>Некорректное поле <code>exp_company</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-City",
            "description": "<p>Некорректное поле <code>exp_city</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Period",
            "description": "<p>Некорректное поле <code>exp_industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Faculty",
            "description": "<p>Некорректное поле <code>work_period</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [exp_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/ExperienceApi.php",
    "groupTitle": "Resume_Experience",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/experience"
      }
    ]
  },
  {
    "type": "post",
    "url": "language",
    "title": "Добавить",
    "name": "AddLanguage",
    "group": "Resume_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lang_id",
            "description": "<p>ID языка</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lang_level",
            "description": "<p>Уровень владения языком</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"lang_id\" : \"3\",\n     \"lang_level\" : \"Не владею\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_id",
            "description": "<p>ID языка</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_level",
            "description": "<p>Уровень владения языком</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"lang_id\" : \"3\",\n    \"lang_level\" : \"Не владею\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "LanguageExists",
            "description": "<p>Язык <code>ID</code> уже добавлен</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>lang_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid2",
            "description": "<p>Объект должен содержать поле <code>lang_level</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LangId",
            "description": "<p>Некорректное поле <code>lang_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LangLevel",
            "description": "<p>Некорректное поле <code>lang_level</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [lang_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/LanguageApi.php",
    "groupTitle": "Resume_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/language"
      }
    ]
  },
  {
    "type": "delete",
    "url": "language",
    "title": "Удалить несколько",
    "name": "DeleteArrayLanguage",
    "group": "Resume_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Массив ID, которые надо удалить</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"data\" : \"1, 2, 3, 4, 5\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Data",
            "description": "<p>Некорректный массив <code>data</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетноый записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/LanguageApi.php",
    "groupTitle": "Resume_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/language"
      }
    ]
  },
  {
    "type": "delete",
    "url": "language/:id",
    "title": "Удалить",
    "name": "DeleteLanguage",
    "group": "Resume_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете удалить чужую запись</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не можете удалить чужую запись\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/LanguageApi.php",
    "groupTitle": "Resume_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/language/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "language",
    "title": "Получить все",
    "name": "GetLanguage",
    "group": "Resume_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_id",
            "description": "<p>ID языка</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_level",
            "description": "<p>Уровень владения языком</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n     {\n         \"id\" : \"1\"\n         \"lang_id\" : \"3\",\n         \"lang_level\" : \"Не владею\"\n     },\n     {\n         \"id\" : \"1\"\n         \"lang_id\" : \"3\",\n         \"lang_level\" : \"Не владею\"\n     }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетной записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетной записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/LanguageApi.php",
    "groupTitle": "Resume_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/language"
      }
    ]
  },
  {
    "type": "put",
    "url": "language",
    "title": "Обновить",
    "name": "UpdateLanguage",
    "group": "Resume_Language",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "record_id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lang_level",
            "description": "<p>Уровень владения языком</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "data",
            "description": "<p>Вы можете отправить массив языков в json формате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"record_id\" : \"3\",\n     \"lang_level\" : \"Не владею\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID записи</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_id",
            "description": "<p>ID языка</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lang_level",
            "description": "<p>Уровень владения языком</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"lang_id\" : \"3\",\n    \"lang_level\" : \"Не владею\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataIsNotValid",
            "description": "<p>Некорректный объект <code>data</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordNotFound",
            "description": "<p>Запись не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid",
            "description": "<p>Объект должен содержать поле <code>record_id</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DataFieldIsNotValid2",
            "description": "<p>Объект должен содержать поле <code>lang_level</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете редактировать чужую запись</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-LangLevel",
            "description": "<p>Некорректное поле <code>lang_level</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле [lang_level]\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/LanguageApi.php",
    "groupTitle": "Resume_Language",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/language"
      }
    ]
  },
  {
    "type": "delete",
    "url": "user/avatar",
    "title": "Удалить аватар",
    "name": "DeleteAvatar",
    "group": "User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не авторизированы\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user/avatar"
      }
    ]
  },
  {
    "type": "get",
    "url": "user/:id",
    "title": "Данные пользователя",
    "name": "GetUser",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>Тип учетной записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    id : 1\n    firstname : Вася\n    lastname : Петренко\n    gender : Мужской\n    email : example@test.com\n    type : 0\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>Пользовтель <code>id</code> не найден.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Пользователь не найден\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "user/avatar",
    "title": "Изменить аватар",
    "name": "UserAvatar",
    "group": "User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Blob",
            "optional": false,
            "field": "avatar",
            "description": "<p>Файл, новый аватар пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     avatar : example.jpeg\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>Путь к файлу</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    source : public/images/avatar/5a2fc338ba3e6.jpg\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "FileDoesNotExist",
            "description": "<p>Файл не был загружен</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "FileMaxSize",
            "description": "<p>Файл не должен весить более 3МБ</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "FileUploadError",
            "description": "<p>Ошибка загрузки файла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Файл не должен весить более 3МБ\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User"
  },
  {
    "type": "delete",
    "url": "user",
    "title": "Удаление учетной записи",
    "name": "UserDelete",
    "group": "User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не авторизированы\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user"
      }
    ]
  },
  {
    "type": "post",
    "url": "user/login",
    "title": "Авторизация",
    "name": "UserLogin",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     email : example@test.com,\n     password : 123456\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>Тип учетной записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    id : 1\n    firstname : Вася\n    lastname : Петренко\n    gender : Мужской\n    email : example@test.com\n    type : 0\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "EmailExists",
            "description": "<p>Email не существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Password",
            "description": "<p>Неверный пароль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Неверный пароль\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user/login"
      }
    ]
  },
  {
    "type": "post",
    "url": "user/logout",
    "title": "Выход",
    "name": "UserLogout",
    "group": "User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Сессия успешно завершена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не авторизированы\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user/logout"
      }
    ]
  },
  {
    "type": "post",
    "url": "user/register",
    "title": "Регистрация",
    "name": "UserRegister",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "type",
            "defaultValue": "0",
            "description": "<p>Тип учетной записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     firstname : Вася,\n     lastname : Петренко,\n     gender : Мужской,\n     email : example@test.com,\n     password : 123456,\n     type : 0\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>Тип учетной записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    id : 1\n    firstname : Вася\n    lastname : Петренко\n    gender : Мужской\n    email : example@test.com\n    type : 0\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "EmailExists",
            "description": "<p>Email уже существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Firstname",
            "description": "<p>Поле <code>firstname</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Lastname",
            "description": "<p>Поле <code>lastname</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Gender",
            "description": "<p>Поле <code>gender</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Email",
            "description": "<p>Поле <code>email</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Password",
            "description": "<p>Поле <code>password</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Type",
            "description": "<p>Поле <code>type</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Firstname",
            "description": "<p>Некорректное поле <code>firstname</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Lastname",
            "description": "<p>Некорректное поле <code>lastname</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Gender",
            "description": "<p>Некорректное поле <code>gender</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Email",
            "description": "<p>Некорректное поле <code>email</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Type",
            "description": "<p>Некорректное поле <code>type</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Некорректное поле <firstname>\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user/register"
      }
    ]
  },
  {
    "type": "put",
    "url": "user",
    "title": "Изменить данные",
    "name": "UserUpdate",
    "group": "User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "firstname",
            "description": "<p>Имя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "lastname",
            "description": "<p>Фамилия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Почта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "old_password",
            "description": "<p>Старый пароль. Необходим для смены пароля</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "password",
            "description": "<p>Новый пароль</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "firstname",
            "description": "<p>Имя пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Фамилия пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "gender",
            "description": "<p>Пол</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "old_password",
            "description": "<p>Старый пароль</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Новый пароль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    firstname : Вася\n    lastname : Петренко\n    gender : Мужской\n    email : example@test.com\n    old_password : 123456\n    password : 1234567\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Firstname",
            "description": "<p>Поле <code>firstname</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Lastname",
            "description": "<p>Поле <code>lastname</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Gender",
            "description": "<p>Поле <code>gender</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Email",
            "description": "<p>Поле <code>email</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Empty-Password",
            "description": "<p>Поле <code>password</code> не должно быть пустым</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Firstname",
            "description": "<p>Некорректное поле <code>firstname</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Lastname",
            "description": "<p>Некорректное поле <code>lastname</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Gender",
            "description": "<p>Некорректное поле <code>gender</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Email",
            "description": "<p>Некорректное поле <code>email</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-OldPassword",
            "description": "<p>Некорректное поле <code>old_password</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не авторизированы\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/UserApi.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/user"
      }
    ]
  },
  {
    "type": "post",
    "url": "vacancy/add",
    "title": "Создать вакансию",
    "name": "AddVacancy",
    "group": "Vacancy",
    "version": "1.0.0",
    "permission": [
      {
        "name": "employer",
        "title": "Учетная запись должна быть типа \"работодатель\"",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Название компании</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефонный номер работодателя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "vacancy",
            "description": "<p>Название вакансии</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Зарплата</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exp",
            "description": "<p>Необходимый опыт работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "location",
            "description": "<p>Место работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "demands",
            "description": "<p>Требования</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "duties",
            "description": "<p>Обязанности</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "conditions",
            "description": "<p>Условаия работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "desc",
            "description": "<p>Описание вакансии</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "schedule",
            "description": "<p>ID графика работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "industry",
            "description": "<p>ID отрасли</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n   email : \"example@test.com\",\n   company : \"ООО Серебряный век\",\n   phone : \"+79999999999\",\n   vacancy : \"Сторож\",\n   salary : \"22000-25000\",\n   exp : \"1\",\n   location : \"Волгоград\",\n   demands : \"Стрессоустойчивость, активность, выдержка\",\n   duties : \"Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу\",\n   conditions : \"Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены\",\n   desc : \"На постоянную работу в дом отдыха с проживанием нужен сторож\",\n   schedule : \"1\",\n   industry : \"5\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_name",
            "description": "<p>Имя работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Название компании</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефонный номер работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "vacancy_name",
            "description": "<p>Название вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_min",
            "description": "<p>Минимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_max",
            "description": "<p>Максимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>Необходимый опыт работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "location",
            "description": "<p>Место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "demands",
            "description": "<p>Требования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "duties",
            "description": "<p>Обязанности</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "conditions",
            "description": "<p>Условаия работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Описание вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Статус (опубликована или нет)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата публикации</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_name",
            "description": "<p>График работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n   id : \"1\",\n   sender_name : \"Василий Петренко\",\n   sender_id : \"5\",\n   email : \"example@test.com\",\n   company : \"ООО Серебряный век\",\n   phone : \"+79999999999\",\n   vacancy_name : \"Сторож\",\n   salary_min : \"22000\",\n   salary_max : \"25000\",\n   experience : \"1\",\n   location : \"Волгоград\",\n   demands : \"Стрессоустойчивость, активность, выдержка\",\n   duties : \"Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу\",\n   conditions : \"Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены\",\n   description : \"На постоянную работу в дом отдыха с проживанием нужен сторож\",\n   status : \"1\",\n   date : \"2017-11-27 08:59:16\",\n   schedule_name : \"Полный день\",\n   industry_name : \"Охрана, безопасность\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Company",
            "description": "<p>Некорректное поле <code>company</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Phone",
            "description": "<p>Некорректное поле <code>phone</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Vacancy",
            "description": "<p>Некорректное поле <code>vacancy</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Salary",
            "description": "<p>Некорректное поле <code>salary</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Experience",
            "description": "<p>Некорректное поле <code>exp</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Location",
            "description": "<p>Некорректное поле <code>location</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Demands",
            "description": "<p>Некорректное поле <code>demands</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Duties",
            "description": "<p>Некорректное поле <code>duties</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Conditions",
            "description": "<p>Некорректное поле <code>conditions</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Description",
            "description": "<p>Некорректное поле <code>desc</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-IndustryID",
            "description": "<p>Некорректное поле <code>industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-ScheduleID",
            "description": "<p>Некорректное поле <code>schedule</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyApi.php",
    "groupTitle": "Vacancy",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy/add"
      }
    ]
  },
  {
    "type": "get",
    "url": "vacancy/:id",
    "title": "Получить вакансию",
    "name": "GetVacancy",
    "group": "Vacancy",
    "version": "1.0.0",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_name",
            "description": "<p>Имя работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Название компании</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефонный номер работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "vacancy_name",
            "description": "<p>Название вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_min",
            "description": "<p>Минимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_max",
            "description": "<p>Максимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>Необходимый опыт работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "location",
            "description": "<p>Место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "demands",
            "description": "<p>Требования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "duties",
            "description": "<p>Обязанности</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "conditions",
            "description": "<p>Условаия работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Описание вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Статус (опубликована или нет)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата публикации</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_name",
            "description": "<p>График работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n   id : \"1\",\n   sender_name : \"Василий Петренко\",\n   sender_id : \"5\",\n   email : \"example@test.com\",\n   company : \"ООО Серебряный век\",\n   phone : \"+79999999999\",\n   vacancy_name : \"Сторож\",\n   salary_min : \"22000\",\n   salary_max : \"25000\",\n   experience : \"1\",\n   location : \"Волгоград\",\n   demands : \"Стрессоустойчивость, активность, выдержка\",\n   duties : \"Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу\",\n   conditions : \"Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены\",\n   description : \"На постоянную работу в дом отдыха с проживанием нужен сторож\",\n   status : \"1\",\n   date : \"2017-11-27 08:59:16\",\n   schedule_name : \"Полный день\",\n   industry_name : \"Охрана, безопасность\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Вакансия <code>id</code> не найдена.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Вакансия не найдена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyApi.php",
    "groupTitle": "Vacancy",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy/:id"
      }
    ]
  },
  {
    "type": "put",
    "url": "vacancy/update/:id",
    "title": "Обновить вакансию",
    "name": "UpdateVacancy",
    "group": "Vacancy",
    "version": "1.0.0",
    "permission": [
      {
        "name": "employer",
        "title": "Учетная запись должна быть типа \"работодатель\"",
        "description": ""
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "company",
            "description": "<p>Название компании</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Телефонный номер работодателя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "vacancy",
            "description": "<p>Название вакансии</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "salary",
            "description": "<p>Зарплата</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "exp",
            "description": "<p>Необходимый опыт работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "location",
            "description": "<p>Место работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "demands",
            "description": "<p>Требования</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "duties",
            "description": "<p>Обязанности</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "conditions",
            "description": "<p>Условаия работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "desc",
            "description": "<p>Описание вакансии</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "schedule",
            "description": "<p>ID графика работы</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "industry",
            "description": "<p>ID отрасли</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n   email : \"example@test.com\",\n   company : \"ООО Серебряный век\",\n   phone : \"+79999999999\",\n   vacancy : \"Сторож\",\n   salary : \"22000-25000\",\n   exp : \"1\",\n   location : \"Волгоград\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_name",
            "description": "<p>Имя работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "sender_id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Название компании</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефонный номер работодателя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "vacancy_name",
            "description": "<p>Название вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_min",
            "description": "<p>Минимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "salary_max",
            "description": "<p>Максимальная зарплата</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>Необходимый опыт работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "location",
            "description": "<p>Место работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "demands",
            "description": "<p>Требования</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "duties",
            "description": "<p>Обязанности</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "conditions",
            "description": "<p>Условаия работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Описание вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Статус (опубликована или нет)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата публикации</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "schedule_name",
            "description": "<p>График работы</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "industry_name",
            "description": "<p>Отрасль</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n   id : \"1\",\n   sender_name : \"Василий Петренко\",\n   sender_id : \"5\",\n   email : \"example@test.com\",\n   company : \"ООО Серебряный век\",\n   phone : \"+79999999999\",\n   vacancy_name : \"Сторож\",\n   salary_min : \"22000\",\n   salary_max : \"25000\",\n   experience : \"1\",\n   location : \"Волгоград\",\n   demands : \"Стрессоустойчивость, активность, выдержка\",\n   duties : \"Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу\",\n   conditions : \"Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены\",\n   description : \"На постоянную работу в дом отдыха с проживанием нужен сторож\",\n   status : \"1\",\n   date : \"2017-11-27 08:59:16\",\n   schedule_name : \"Полный день\",\n   industry_name : \"Охрана, безопасность\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Company",
            "description": "<p>Некорректное поле <code>company</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Phone",
            "description": "<p>Некорректное поле <code>phone</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Vacancy",
            "description": "<p>Некорректное поле <code>vacancy</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Salary",
            "description": "<p>Некорректное поле <code>salary</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Experience",
            "description": "<p>Некорректное поле <code>exp</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Location",
            "description": "<p>Некорректное поле <code>location</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Demands",
            "description": "<p>Некорректное поле <code>demands</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Duties",
            "description": "<p>Некорректное поле <code>duties</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Conditions",
            "description": "<p>Некорректное поле <code>conditions</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-Description",
            "description": "<p>Некорректное поле <code>desc</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-IndustryID",
            "description": "<p>Некорректное поле <code>industry</code></p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Invalid-ScheduleID",
            "description": "<p>Некорректное поле <code>schedule</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для выполнения данной операции\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyApi.php",
    "groupTitle": "Vacancy",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy/update/:id"
      }
    ]
  },
  {
    "type": "delete",
    "url": "vacancy/delete/:id",
    "title": "Удалить вакансию",
    "name": "VacancyDelete",
    "group": "Vacancy",
    "version": "1.0.0",
    "permission": [
      {
        "name": "employer",
        "title": "Учетная запись должна быть типа \"работодатель\"",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Сессия успешно завершена</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyNotFound",
            "description": "<p>Вакансия не найдена</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>У вас недостаточно прав для выполнения данной операции</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied2",
            "description": "<p>У вас недостаточно прав для удаления данной записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"У вас недостаточно прав для удаления данной записи\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyApi.php",
    "groupTitle": "Vacancy",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy/delete/:id"
      }
    ]
  },
  {
    "type": "post",
    "url": "vacancy_resume/:id",
    "title": "Добавить свое резюме к вакансии",
    "name": "AddVacancyResume",
    "group": "Vacancy_Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID пользователя</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "vacancy_id",
            "description": "<p>ID вакансии</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"id\" : \"1\"\n    \"vacancy_id\" : \"4\"\n    \"user_id\" : \"7\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordExists",
            "description": "<p>Вы уже отправили резюме</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyDoesNotExist",
            "description": "<p>Вакансия не существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 400 Bad Request\n{\n  \"error\": \"Вы уже отправили резюме\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyAddedResumeApi.php",
    "groupTitle": "Vacancy_Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy_resume/:id"
      }
    ]
  },
  {
    "type": "delete",
    "url": "vacancy_resume/:id",
    "title": "Удалить свое резюме из вакансии",
    "name": "DeleteVacancyResume",
    "group": "Vacancy_Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>Удаление прошло успешно</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    success : true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RecordDoesNotExist",
            "description": "<p>Запись не существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyDoesNotExist",
            "description": "<p>Вакансия не существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 404 Not Found\n{\n  \"error\": \"Запись не существует\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyAddedResumeApi.php",
    "groupTitle": "Vacancy_Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy_resume/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "vacancy_resume/employer",
    "title": "Отправленные резюме для всех вакансий",
    "name": "GetAllEmployerVacancyResume",
    "group": "Vacancy_Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "employer",
        "title": "Учетная запись должна быть типа \"работодатель\"",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID вакансии</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n  \"6\": [\n         {\n             \"user_id\": \"3\"\n         }\n  ],\n  \"7\": [\n         {\n             \"user_id\": \"3\"\n         },\n         {\n             \"user_id\": \"4\"\n         }\n  ]\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью работодателя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетноый записью работодателя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyAddedResumeApi.php",
    "groupTitle": "Vacancy_Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy_resume/employer"
      }
    ]
  },
  {
    "type": "get",
    "url": "vacancy_resume/employer/:id",
    "title": "Отправленные резюме для вакансии",
    "name": "GetEmployerVacancyResume",
    "group": "Vacancy_Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "employer",
        "title": "Учетная запись должна быть типа \"работодатель\"",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID вакансии</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"user_id\" : \"4\"\n    },\n    {\n        \"user_id\" : \"15\"\n    },\n    {\n        \"user_id\" : \"7\"\n    },\n    {\n        \"user_id\" : \"8\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "VacancyDoesNotExist",
            "description": "<p>Вакансия не существует</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью работодателя</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PermissionDenied",
            "description": "<p>Вы не можете получить данные чужой записи</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы не можете получить данные чужой записи\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyAddedResumeApi.php",
    "groupTitle": "Vacancy_Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy_resume/employer/:id"
      }
    ]
  },
  {
    "type": "get",
    "url": "vacancy_resume/user",
    "title": "Отправленные резюме для пользователя",
    "name": "GetUserVacancyResume",
    "group": "Vacancy_Resume",
    "version": "1.0.0",
    "permission": [
      {
        "name": "auth",
        "title": "Вы должны быть авторизированы под учетноый записью пользователя",
        "description": ""
      }
    ],
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "vacancy_id",
            "description": "<p>ID вакансии</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "[\n    {\n        \"vacancy_id\" : \"4\"\n    },\n    {\n        \"vacancy_id\" : \"15\"\n    },\n    {\n        \"vacancy_id\" : \"7\"\n    },\n    {\n        \"vacancy_id\" : \"8\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Auth",
            "description": "<p>Вы не авторизированы</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserAuth",
            "description": "<p>Вы должны быть авторизированы под учетноый записью пользователя</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\nHTTP/1.1 403 Forbidden\n{\n  \"error\": \"Вы должны быть авторизированы под учетноый записью пользователя\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/api/VacancyAddedResumeApi.php",
    "groupTitle": "Vacancy_Resume",
    "sampleRequest": [
      {
        "url": "http://project/api/1.0.0/vacancy_resume/user"
      }
    ]
  }
] });