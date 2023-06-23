import { Drake } from 'dragula';
export default function useDragula(handleClass?: string): {
    dragulaDecorator: (container: HTMLDivElement | null) => void;
    drake: Drake | null;
};
