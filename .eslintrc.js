/* eslint-disable no-undef, unicorn/prefer-module */

module.exports = {
  root: true,
  extends: [
    'plugin:vue/vue3-recommended',
    'eslint:recommended',
    'plugin:@typescript-eslint/recommended',
    'plugin:unicorn/recommended',
    'plugin:import/recommended',
    'plugin:import/typescript',
    'plugin:prettier/recommended',
    '@vue/eslint-config-typescript/recommended',
  ],
  parser: 'vue-eslint-parser',
  parserOptions: {
    tsconfigRootDir: __dirname,
  },
  settings: {
    'import/resolver': {
      typescript: {
        project: [__dirname + '/tsconfig.json', __dirname + '/tsconfig.*.json'],
      },
    },
  },
  env: {
    'vue/setup-compiler-macros': true,
  },
  overrides: [
    {
      files: ['*.vue'],
      rules: require('@typescript-eslint/eslint-plugin').configs[
        'eslint-recommended'
      ].overrides.find((override) => override.files.includes('*.ts')).rules,
    },
    // {
    //   files: ['*.vue'],
    //   extends: [
    //     'plugin:@typescript-eslint/recommended-requiring-type-checking',
    //     'plugin:@typescript-eslint/strict',
    //   ],
    //   parser: 'vue-eslint-parser',
    //   parserOptions: {
    //     parser: '@typescript-eslint/parser',
    //     project: ['./tsconfig.app.json'],
    //   },
    //   rules: {
    //     '@typescript-eslint/array-type': ['error', { default: 'array-simple' }],
    //     '@typescript-eslint/prefer-function-type': 'off',
    //   },
    // },
  ],
  ignorePatterns: ['node_modules/', 'dist/', 'coverage/', 'vendor/'],
  rules: {
    'vue/multi-word-component-names': 'off',
    '@typescript-eslint/no-explicit-any': 'off',
    'no-console':
      process.env.NODE_ENV === 'production'
        ? ['warn', { allow: ['debug'] }]
        : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',

    '@typescript-eslint/no-extra-semi': 'off', // collides with prettier
    '@typescript-eslint/no-unused-vars': [
      'error',
      { destructuredArrayIgnorePattern: '^_' },
    ], // useful for map() when returning same format

    'unicorn/filename-case': 'off',
    'unicorn/prevent-abbreviations': 'off',
    'unicorn/no-useless-undefined': 'off',
    'import/order': [
      'warn',
      {
        groups: [
          'builtin',
          'external',
          'internal',
          'parent',
          'sibling',
          'index',
          'object',
          'type',
        ],
        pathGroups: [
          {
            pattern: '@/**',
            group: 'internal',
          },
        ],
        'newlines-between': 'always',
        alphabetize: {
          order:
            'asc' /* sort in ascending order. Options: ['ignore', 'asc', 'desc'] */,
          caseInsensitive: false,
        },
      },
    ],
  },
}
