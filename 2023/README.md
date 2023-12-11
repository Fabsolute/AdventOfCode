# Livebook

[![Website](https://img.shields.io/badge/-Website-%23ff87a7)](https://livebook.dev/)
[![Latest Version](https://img.shields.io/hexpm/v/livebook?color=b5a3be&label=Latest+version)](https://hexdocs.pm/livebook)

Livebook is a web application for writing interactive and collaborative code notebooks. It features:

  * Code notebooks with Markdown support and Code cells where Elixir code is evaluated on demand.

  * Rich code editor through [Monaco](https://microsoft.github.io/monaco-editor/): with support for autocompletion, inline documentation, code formatting, etc.

  * Interactive results via [Kino](https://github.com/elixir-nx/kino): display [Vega-Lite charts](https://vega.github.io/vega-lite/), tables, maps, and more.

  * Automation: use Smart cells to perform high-level tasks and write notebooks faster than ever. Query databases, plot charts, build maps, and more directly from Livebook's UI.

  * Reproducible: Livebook ensures your code runs in a predictable order, all the way down to package management. It also tracks your notebook state, annotating which parts are stale.

  * Collaboration: multiple users can work on the same notebook at once, no additional setup required.

  * Decentralized: Livebook is open-source and you can run it anywhere. The ["Run in Livebook" badge](https://livebook.dev/badge) makes it easy to import any Livebook into your own Livebook.

  * Versionable: notebooks are stored in the `.livemd` format, which is a subset of Markdown with support for diagrams via [Mermaid](https://mermaid-js.github.io/mermaid) and for mathematical formulas via [KaTex](https://katex.org/). `.livemd` files can be shared and play well with version control.

  * Custom runtimes: when executing Elixir code, you can either start a fresh Elixir instance, connect to an existing node, or run it inside an existing Elixir project, with access to all of its modules and dependencies. This means Livebook can be a great tool to introspect and document existing projects too.

## Getting started

Head out to [the Install section](https://livebook.dev/#install) of Livebook's website to get started. Once Livebook is up and running on your machine, **visit the "Learn" section** with introductory guides and documentation on several Livebook features. Here is a sneak peak of the "Welcome to Livebook" guide:

![Screenshot](https://github.com/livebook-dev/livebook/raw/main/.github/imgs/welcome.png)

For screencasts and news, check out [news.livebook.dev](https://news.livebook.dev/).

## Installation

We provide several methods for running Livebook,
pick the one that best fits your use case.

### Desktop app

  * [Download the installer for Mac and Windows from our homepage](https://livebook.dev/#install)

  * Latest stable builds: [Mac (Universal)](https://livebook.dev/releases/latest/LivebookInstall-latest-macos-universal.dmg),
    [Windows](https://livebook.dev/releases/latest/LivebookInstall-latest-windows-x86_64.exe)

  * Nightly builds: [Mac (Universal)](https://livebook.dev/releases/nightly/LivebookInstall-nightly-macos-universal.dmg),
    [Windows](https://livebook.dev/releases/nightly/LivebookInstall-nightly-windows-x86_64.exe)

  * Builds for particular Livebook version are available on our
    [GitHub releases](https://github.com/livebook-dev/livebook/releases).
