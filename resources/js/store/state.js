export const state = {
    mainColor: "#9C1820",
    routeGetDirectory: "/media-api/index/",
    routeGetMedia: "/media-api/show/",
    routeCreateDirectory: "/media-api/directory/create",
    routeDeleteDirectory: "/media-api/directory/destroy",
    routeDeleteMedia: "/media-api/destroy",
    routeMoveDirectory: "/media-api/directory/update",
    routeSearchMedia: "/media-api/search",
    routeUpdateMedia: "/media-api/update",
    hideDirectory: false,
    currentDirectory: null,
    selectedDirectory: null,
    selectedTranslation: null,
    totalSelected: 0,
    modalState: {
        add: false,
        create: false,
        delete: false,
        move: false
    },
    folderState: true,
    viewState: false,
    selectedElem: [],
    directoryCollection: [],
    moveDirectoryCollection: [],
    mediaCollection: [],
    mediaTypeArray: [],
    orderBy: "created_at",
    orderDirection: "asc",
    isLoading: true,
    isLoadingSidePanel: false,
    isSearch: false,
    haveContextMenu: false,
    lang: 'en',
    pageCount: null
};
