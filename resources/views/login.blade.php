<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
  </head>

  <body>
    <div class="flex flex-col p-8">
      <h2 class="mt-4 text-center text-3xl font-bold">ログイン</h2>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="/login" method="POST">
          @csrf
          <div class="mt-4">
            <label for="email" class="text-sm font-medium">メールアドレス</label>
            <div class="mt-2">
              <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                placeholder="test@example.com"
                class="w-full rounded-md border-0 p-2 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:leading-6"
              />
              @error('email')
              <div
                class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 mt-1 text-sm rounded relative"
                role="alert"
              >
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="mt-6">
            <label for="password" class="text-sm font-medium"> パスワード </label>
            <div class="mt-2">
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="w-full rounded-md border-0 p-2 ring-1 ring-inset ring-gray-300 sm:leading-6"
              />
              @error('password')
              <div
                class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 mt-1 text-sm rounded relative"
                role="alert"
              >
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="flex justify-center mt-10">
            <button
              type="submit"
              class="flex w-full sm:w-1/2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              ログインする
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
