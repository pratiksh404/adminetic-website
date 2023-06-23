import { MediaLibrary } from './types';

export function findObjectIndexByUuid(rootState: MediaLibrary.State, uuid: string) {
    return rootState.media.findIndex((mediaObject) => mediaObject.attributes.uuid === uuid);
}
