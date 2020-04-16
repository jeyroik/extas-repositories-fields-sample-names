![PHP Composer](https://github.com/jeyroik/extas-repositories-fields-sample-names/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-repositories-fields-sample-names/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>

# Описание

Позволяет подставлять в имя сущности имя её сэмпла (шаблона) с суффиксом или без него.

# Использование

extas.json

```json
{
    "plugins": [
        {
            "class": "extas\\components\\plugins\\repositories\\PluginFieldSampleName",
            "stage": "extas.<entity>.before.create
        }
    ]
}
```

Имя сущности может
- быть пустым: в этом случае просто подставится имя сэмпла;
- содержать @sample(uuid6) и остальные варианты подстановки uuid (см. [extas-repositories-fields-uuid](https://github.com/jeyroik/extas-repositories-fields-uuid)) для подставноки в качестве суффикса uuid-строки;
- содержать @sample(sha1(...)) для подстановки хэша sha1 (см. [extas-repositories-fields-sha1](https://github.com/jeyroik/extas-repositories-fields-sha1)).

Суффикс добавляется через символ `_`.