import axios, { CancelTokenSource } from 'axios';
import { MediaLibrary } from '.';
import vaporUpload from './vapor';

export function getCancelTokenSource() {
    return axios.CancelToken.source();
}

export const api = axios.create();

type UploadFileProps = {
    routePrefix: string;
    file: File;
    uuid: string;
    cancelTokenSource: CancelTokenSource;
    vapor: MediaLibrary['config']['vapor'];
    vaporSignedStorageUrl: MediaLibrary['config']['vaporSignedStorageUrl'];
    uploadDomain: string;
    withCredentials: boolean;
    headers: Record<string, string>;
    onUploadProgress: (progress: ProgressEvent) => void;
};

export async function uploadFile({
    routePrefix,
    file,
    uuid,
    cancelTokenSource,
    vapor,
    vaporSignedStorageUrl,
    uploadDomain,
    withCredentials,
    headers,
    onUploadProgress,
}: UploadFileProps) {
    if (vapor) {
        const response = await vaporUpload(file, {
            onUploadProgress,
            signedStorageUrl: vaporSignedStorageUrl,
            withCredentials,
        });

        return api.post(
            uploadDomain + '/' + routePrefix + '/post-s3',
            {
                uuid: response.uuid,
                key: response.key,
                bucket: response.bucket,
                name: file.name,
                size: file.size,
                content_type: file.type,
            },
            { withCredentials, headers }
        );
    }

    const formData = new FormData();

    formData.append('file', file);
    formData.append('name', file.name);
    formData.append('uuid', uuid);

    return api.post(uploadDomain + '/' + routePrefix + '/uploads', formData, {
        withCredentials,
        cancelToken: cancelTokenSource.token,
        headers: {
            'Content-Type': 'multipart/form-data',
            ...headers,
        },
        onUploadProgress,
    });
}
