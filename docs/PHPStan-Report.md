# Error Report by PHPStan

## Summary

### Total errors found: 431
### Improvements: 814

Here's a summary of the errors by severity.

<table>
	<thead>
		<td></td>
		<th>Level</th>
		<th>Errors</th>
	</thead>
	<tr class="danger">
		<th></th>
		<td>Critical</td>
		<td>318</td>
	</tr>
	<tr class="warning">
		<th></th>
		<td>Warning</td>
		<td>113</td>
	</tr>
	<tr class="improvement">
		<th></th>
		<td>Improvement</td>
		<td>814</td>
	</tr>
</table>

The following table shows the amount of errors found at each rule level.

|     | Level | Errors | Total | File                                      |
| --- | :---: | -----: | ----: | ----------------------------------------- |
| 🔴   |   0   |      4 |     4 | [phpstan-0.md](docs/reports/phpstan-0.md) |
| 🔴   |   1   |    314 |   318 | [phpstan-1.md](docs/reports/phpstan-1.md) |
| 🟠   |   2   |     70 |   388 | [phpstan-2.md](docs/reports/phpstan-2.md) |
| 🟡   |   3   |     30 |   418 | [phpstan-3.md](docs/reports/phpstan-3.md) |
| 🟡   |   4   |     13 |   431 | [phpstan-4.md](docs/reports/phpstan-4.md) |
| 🟡   |   5   |      0 |   431 | [phpstan-5.md](docs/reports/phpstan-5.md) |
| 🔵   |   6   |    554 |   985 | [phpstan-6.md](docs/reports/phpstan-6.md) |
| 🔵   |   7   |     20 |  1005 | [phpstan-7.md](docs/reports/phpstan-7.md) |
| 🔵   |   8   |      8 |  1013 | [phpstan-8.md](docs/reports/phpstan-8.md) |
| 🔵   |   9   |    232 |  1245 | [phpstan-8.md](docs/reports/phpstan-9.md) |

## Details

All the reports can be found in the [docs/reports](docs/reports) folder.

Error reports were generated using [PHPStan](https://github.com/phpstan/phpstan) with rule levels from 0 to 8. As the rule level increases, the rules become more strict and the amount of errors found increases. So errors found at lower levels are more severe than the errors found at higher levels. To check the errors found at a specific level, please refer to the PHPStan [rule levels documentation](https://phpstan.org/user-guide/rule-levels). Note that each level includes all the errors found at the previous levels.

Here's a summary of the errors found at each level.

<style>
	table.levels th, table.levels td {
		border: 1px solid #000;
	}

	.levels th {
		color: #fff;
	}

	.danger, .danger th {
		background-color: #B50029;
	}

	.danger td {
		background-color: #FED8D9;
	}

	.warning th {
		background-color: #ffcc00;
		color: #630;
	}

	.warning td {
		background-color: #fbf4be;
	}

	.improvement {
		background-color: #007dd6;
	}

	.improvement td {
		background-color: #d4f2fb;
	}
</style>

<table class="levels">
	<tr class="danger">
		<th rowspan="7">Level 0</th>
	</tr>
	<tr class="danger"><td>basic checks</td></tr>
	<tr class="danger"><td>unknown classes</td></tr>
	<tr class="danger"><td>unknown functions</td></tr>
	<tr class="danger"><td>unknown methods called on $this</td></tr>
	<tr class="danger"><td>wrong number of arguments passed to those methods and functions</td></tr>
	<tr class="danger"><td>always undefined variables</td></tr>
	<!-- LEVEL 1 -->
	<tr class="danger">
		<th rowspan="3">Level 1</th>
	</tr>
	<tr class="danger"><td>possibly undefined variables</td></tr>
	<tr class="danger"><td>unknown magic methods and properties on classes with __call and __get</td></tr>
	<!-- LEVEL 2 -->
	<tr class="danger">
		<th rowspan="2">Level 2</th>
	</tr>
	<tr class="danger"><td>unknown methods checked on all expressions (not just $this)</td></tr>
	<tr class="warning">
		<th rowspan="2">Level 2</th>
	</tr>
	<tr class="warning"><td>validating PHPDocs</td></tr>
	<!-- LEVEL 3 -->
	<tr class="warning">
		<th rowspan="3">Level 3</th>
	</tr>
	<tr class="warning">
		<td>return types</td>
	</tr>
	<tr class="warning">
		<td>types assigned to properties</>
	</tr>
	<!-- LEVEL 4 -->
	<tr class="warning">
		<th rowspan="2">Level 4</th>
	</tr>
	<tr class="warning">
		<td>basic dead code checking (always false instanceof and other type checks, dead else branches, unreachable code after return)</td>
	</tr>
	<!-- LEVEL 5 -->
	<tr class="warning">
		<th rowspan="2">Level 5</th>
	</tr>
	<tr class="warning">
		<td>checking types of arguments passed to methods and functions</td>
	</tr>
	<!-- LEVEL 6 -->
	<tr class="improvement">
		<th rowspan="2">Level 6</th>
	</tr>
	<tr class="improvement">
		<td>report missing typehints</td>
	</tr>
	<!-- LEVEL 7 -->
	<tr class="improvement">
		<th rowspan="3">Level 7</th>
	</tr>
	<tr class="improvement">
		<td>report partially wrong union types</td>
	</tr>
	<tr class="improvement">
		<td>other **possibly** incorrect situations</td>
	</tr>
	<!-- LEVEL 8 -->
	<tr class="improvement">
		<th rowspan="2">Level 8</th>
	</tr>
	<tr class="improvement">
		<td>report calling methods and accessing properties on nullable types</td>
	</tr>
	<!-- LEVEL 9 -->
	<tr class="improvement">
		<th rowspan="2">Level 9</th>
	</tr>
	<tr class="improvement">
		<td>be strict about the mixed type - the only allowed operation you can do with it is to pass it to another mixed</td>
	</tr>
</table>

## Report Generation

You must have php 7.4 installed, and install dependencies using composer first.

To generate a report use the command below replacing `LEVEL` by the rules level you want.

```
$ vendor/bin/phpstan analyse --memory-limit 1G --level LEVEL
```

### PHPStan Settings

`phpstan.neon`
```neon
parameters:
    level: 8
    checkMissingIterableValueType: false
    treatPhpDocTypesAsCertain: false
    checkImplicitMixed: true
    checkUninitializedProperties: true
    
    paths:
        - src
        
    excludePaths:
        - src/Command
        - src/Console
```