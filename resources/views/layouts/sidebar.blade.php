            <div class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto border-r">
                <h2 class="text-2xl font-semibold text-center text-blue-800">CSプロジェクト管理</h2>

                <div class="flex flex-col justify-between mt-6">
                    <aside>
                        <ul>
                            <li>
                            @if (request()->routeIs('project.index'))
                                <a class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-md" href="{{ route('project.index') }}">
                            @else
                                <a class="flex items-center px-4 py-2 text-gray-600 rounded-md hover:bg-gray-200" href="{{ route('project.index') }}">
                            @endif
                                    <i class="far fa-comment-alt"></i>
                                    <span class="mx-4 font-medium">{{ __('プロジェクト') }}</span>
                                </a>
                            </li>

                            <li>
                            @if (request()->routeIs('crowd_sourcing.index'))
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-700 bg-gray-100 rounded-md" href="{{ route('crowd_sourcing.index') }}">
                            @else
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 rounded-md hover:bg-gray-200" href="{{ route('crowd_sourcing.index') }}">
                            @endif
                                    <i class="far fa-copyright"></i>
                                    <span class="mx-4 font-medium">{{ __('クラウドソーシング') }}</span>
                                </a>
                            </li>

                            <li>
                            @if (request()->routeIs('orderer.index'))
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-700 bg-gray-100 rounded-md" href="{{ route('orderer.index') }}">
                            @else
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 rounded-md hover:bg-gray-200" href="{{ route('orderer.index') }}">
                            @endif
                                    <i class="far fa-bell"></i>
                                    <span class="mx-4 font-medium">{{ __('発注者') }}</span>
                                </a>
                            </li>

                            <li>
                            @if (request()->routeIs('progress.index'))
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-700 bg-gray-100 rounded-md" href="{{ route('progress.index') }}">
                            @else
                                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 rounded-md hover:bg-gray-200" href="{{ route('progress.index') }}">
                            @endif
                                    <i class="far fa-play-circle"></i>
                                    <span class="mx-4 font-medium">{{ __('進捗') }}</span>
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
